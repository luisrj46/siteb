<?php

namespace Database\Seeders\BiomedicalEquipment;

use App\Models\BiomedicalEquipment\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::upsert([
            ['name' => 'PATOLOGÍA', 'slug' => Service::PATHOLOGY],
            ['name' => 'GESTION PRE-TRANSFUSIONAL', 'slug' => Service::PRE_TRANSFUSIONAL_MANAGEMENT],
            ['name' => 'IMÁGENES DIAGNOSTICAS - NO IONIZANTES', 'slug' => Service::DIAGNOSTIC_IMAGES_NON_IONIZING],
            ['name' => 'IMÁGENES DIAGNOSTICAS - IONIZANTES', 'slug' => Service::DIAGNOSTIC_IMAGES_IONIZING],
            ['name' => 'DIAGNÓSTICO VASCULAR', 'slug' => Service::VASCULAR_DIAGNOSIS],
            ['name' => 'FONOAUDIOLOGÍA Y/O TERAPIA DEL LENGUAJE', 'slug' => Service::PHONE_AUDIOLOGY_AND_OR_LANGUAGE_THERAPY],
            ['name' => 'FISIOTERAPIA', 'slug' => Service::PHYSIOTHERAPY],
            ['name' => 'TERAPIA RESPIRATORIA', 'slug' => Service::RESPIRATORY_THERAPY],
            ['name' => 'TERAPIA OCUPACIONAL', 'slug' => Service::OCCUPATIONAL_THERAPY],
            ['name' => 'SERVICIO FARMACÉUTICO', 'slug' => Service::PHARMACEUTICAL_SERVICE],
            ['name' => 'RADIOTERAPIA', 'slug' => Service::RADIOTHERAPY],
            ['name' => 'QUIMIOTERAPIA', 'slug' => Service::CHEMOTHERAPY],
            ['name' => 'LABORATORIO CLÍNICO', 'slug' => Service::CLINICAL_LABORATORY],
            ['name' => 'TRANSPORTE ASISTENCIAL MEDICALIZADO', 'slug' => Service::MEDICALIZED_CARE_TRANSPORTATION],
            ['name' => 'TRANSPORTE ASISTENCIAL BASICO', 'slug' => Service::BASIC_ASSISTANCE_TRANSPORTATION],
            ['name' => 'URGENCIAS', 'slug' => Service::EMERGENCIES],
            ['name' => 'ATENCIÓN DEL PARTO', 'slug' => Service::BIRTH_CARE],
            ['name' => 'OFTALMOLOGÍA', 'slug' => Service::OPHTHALMOLOGY],
            ['name' => 'ORTOPEDIA Y/O TRAUMATOLOGÍA', 'slug' => Service::ORTHOPEDIC_AND_OR_TRAUMATOLOGY],
            ['name' => 'OTORRINOLARINGOLOGÍA', 'slug' => Service::OTORHINOLARYNGOLOGY],
            ['name' => 'PEDIATRÍA', 'slug' => Service::PEDIATRICS],
            ['name' => 'PSICOLOGÍA', 'slug' => Service::PSYCHOLOGY],
            ['name' => 'PSIQUIATRÍA', 'slug' => Service::PSYCHIATRY],
            ['name' => 'REUMATOLOGÍA', 'slug' => Service::RHEUMATOLOGY],
            ['name' => 'TOXICOLOGÍA', 'slug' => Service::TOXICOLOGY],
            ['name' => 'UROLOGÍA', 'slug' => Service::UROLOGY],
            ['name' => 'OTRAS CONSULTAS DE ESPECIALIDAD', 'slug' => Service::OTHER_SPECIALTY_CONSULTATIONS],
            ['name' => 'CARDIOLOGÍA PEDIÁTRICA', 'slug' => Service::PEDIATRIC_CARDIOLOGY],
            ['name' => 'CIRUGÍA DE MANO', 'slug' => Service::HAND_SURGERY],
            ['name' => 'CIRUGÍA DE MAMA Y TUMORES TEJIDOS BLANDOS', 'slug' => Service::BREAST_SURGERY_AND_SOFT_TISSUE_TUMORS],
        ],['slug'],['name']);
    }
}
