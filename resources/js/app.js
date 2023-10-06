"use strict";
const App = {
    modal: {
        init: function ({
            id = "kt_modal_App",
            size = undefined,
            statict = undefined,
        }) {
            let modal = new bootstrap.Modal("#" + id);
            let modalElement = $(modal._element);
            let sizes = { sm: "modal-sm", lg: "modal-lg", xl: "modal-xl" };
            let sizeModal = sizes[size];

            if (sizeModal != undefined || size == "md") {
                let sizesClass = Object.values(sizes).join(" ");
                let modalDialog = modalElement.find(".modal-dialog");
                modalDialog.removeClass(sizesClass);
                if (size !== undefined) modalDialog.addClass(sizeModal);
            }
            if (statict) {
                modalElement.attr("data-bs-backdrop", "static");
            }
            modalElement.find("#_title").text("");
            modalElement.find("#_body").html("");
            modalElement.find("#_footer").html("");

            return modal;
        },
        setTitle: function (modal, title) {
            if (title == undefined)
                return console.error("Debe enviar el titulo");
            $(modal._element).find("#_title").text(title);
        },
        setBody: function (modal, body) {
            if (body == undefined) return console.error("Debe enviar el body");
            $(modal._element).find("#_body").html(body);
        },
        setFooter: function (modal, footer) {
            if (footer == undefined)
                return console.error("Debe enviar el footer");
            let FOOTERDIV = $(modal._element).find("#_footer");

            if (FOOTERDIV.length == 0) {
                $(modal._element)
                    .find(".modal-content")
                    .append(
                        `
                    <div id="_footer" class="modal-footer">
                        ${footer}
                    </div>
                    `
                    );
                return;
            }

            $(modal._element).find("#_footer").html(footer);
        },
        openForm: function (BTN, modelTitle) {
            if (
                modelTitle == "" ||
                modelTitle == undefined ||
                BTN == "" ||
                BTN == undefined
            ) {
                return Swal.fire(
                    "error",
                    "Debe enviar el boton y el titulo del modelo",
                    "error"
                );
            }

            let BTN_ELEMENT = $(BTN);

            axios
                .get(BTN_ELEMENT.data("route"), {
                    params: {
                        action: BTN_ELEMENT.data("action"),
                        modelTitle: modelTitle,
                    },
                })
                .then(function (response) {
                    let data = response.data;

                    let modal = App.modal.init({
                        size: BTN_ELEMENT.data("modal-size") ?? "lg",
                        statict: BTN_ELEMENT.data("modal-static"),
                        id: BTN_ELEMENT.data("modal-id"),
                    });
                    App.modal.setTitle(modal, data.title);
                    App.modal.setBody(modal, data.body);
                    if (data.footer != undefined)
                        App.modal.setFooter(modal, data.footer);
                    modal.show();
                })
                .catch(function (error) {
                    Swal.fire(
                        error?.message,
                        error?.response?.data?.message,
                        "error"
                    );
                });
        },
        sendForm: function (btn, initializeDataTable = null) {
            // Show loading indication
            let btnElement = $(btn);
            let modal = btnElement.closest(".modal.show");
            let idForm = btnElement.attr("idForm");
            let formElement = modal.find("form");
            let url = formElement.attr("action");
            let method = formElement.attr("method");
            let formId = formElement.attr("id");

            let form = document.querySelector("#" + formId);
            $("span[id^=error_]").addClass("d-none");

            btnElement.attr("data-kt-indicator", "on");
            btnElement.prop("disabled", true);

            let methodAxios = null;

            switch (method) {
                case "POST":
                    const formData = new FormData(form);
                    methodAxios = axios.post(url, formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    });
                    break;
                case "PUT":
                    let data = $("#" + formId).serialize();
                    methodAxios = axios.put(url, data);

                    break;
                case "DELETE":
                    methodAxios = axios.delete(url);

                    break;

                default:
                    console.error("Methodo no identificado");
                    break;
            }

            methodAxios
                ?.then((res) => {
                    if (initializeDataTable) {
                        initializeDataTable.draw('page');
                    }
                    let btnClosedModel = modal
                        .find('[data-bs-dismiss="modal"]')
                        .first();
                    btnClosedModel.trigger("click");
                    Swal.fire(res.statusText, res?.data?.message, "success");
                })
                .catch((err) => {
                    let codeError = err?.response?.status;
                    switch (codeError) {
                        case 422:
                            let errors = err?.response?.data?.errors;
                            let spanError = null;
                            for (const property in errors) {
                                let errs = new Array();
                                let result = property.split(".");
                                spanError = $("span[id^=error_" + result[0]+']')
                                    .removeClass("d-none")
                                    .text("Error");
                                errors[property].forEach((message) => {
                                    errs.push(message);
                                });
                                spanError.text(errs.join("; "));
                            }
                            toastr.options = {
                                closeButton: false,
                                debug: false,
                                newestOnTop: false,
                                progressBar: false,
                                positionClass: "toastr-top-right",
                                preventDuplicates: false,
                                onclick: null,
                                showDuration: "300",
                                hideDuration: "1000",
                                timeOut: "5000",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                            };

                            toastr.error(
                                "Por favor ingresar todos los campos obligatorios",
                                "Error"
                            );
                            break;

                        default:
                            Swal.fire(
                                err?.message,
                                err?.response?.data?.message,
                                "error"
                            );
                            break;
                    }
                })
                .finally(() => {
                    setTimeout(() => {
                        // Hide loading indication
                        btnElement.removeAttr("data-kt-indicator");

                        // Enable button
                        btnElement.prop("disabled", false);
                    }, 1000);
                });
        },
    },
    dataTable: {
        init: function (id) {
            let columns = JSON.parse($("#" + id).attr("columns-table"));
            let columnDefs = JSON.parse($("#" + id).attr("column-defs-table"));
            return $("#" + id).DataTable({
                order:[0, 'desc'],
                responsive: true,
                serverSide: true,
                processing: true,
                searchDelay: 1500,
                ajax: {
                    url: $(this).attr("route"),
                    error: function (xhr, error, code) {
                        Swal.fire(code, xhr?.responseJSON?.message, "error");
                        // setTimeout(() => {
                        //     location.reload();
                        // }, 1500);
                    },
                },
                columns: columns,
                columnDefs: columnDefs,
                dom:
                    "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +
                    "<'table-responsive'tr>" +
                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
            });
        },
    },
    showError: {
        default: function (title, text) {
            Swal.fire(title, text, "error");
        },
    },
};
