<?php

namespace Tests\Browser;

use App\Models\User\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserCrudTest extends DuskTestCase
{

    /**
     * @group userx
     */
    public function testListarUsuarios(): void
    {
        $user = User::find(1);
        $userLast = User::get()->last();
        
        $this->browse(function (Browser $browser) use ($user, $userLast) {
            $browser->loginAs($user)
                    ->visitRoute('users.index')
                    ->waitFor('#table_users', 10)
                    ->with('#table_users', function (Browser $table) use ($user,$userLast) {
                        $table->assertSee($userLast->name);
                    })
                    ->assertPathIs('/admin/users')
                    ->waitForText('Listado de usuarios');
        });
    }

    /**
     * @group user
     */
    public function testCreateUser(): void
    {
        $user = User::find(1);
        
        $this->browse(function (Browser $browser) use ($user) {
            $userNew = fake()->name();
            $browser->loginAs($user)
                    ->visit(route('users.index'))
                    ->press('Registrar')
                    ->whenAvailable('.modal', function (Browser $modal) use($userNew) {
                        $modal->assertSee('Crear usuario')
                        ->value('#id_name', $userNew)
                        ->value('#id_document', fake()->imei())
                        ->value('#id_email', fake()->unique()->safeEmail().'.es')
                        ->value('#id_phone', fake()->e164PhoneNumber())
                        ->value('#id_address', fake()->address())
                        ->select('#id_roles', range(1,3))
                        ->value('#id_password', 'password')
                        ->value('#id_password_confirmed', 'password')
                        ->click('@id_btn_send_user');
                    })
                    ->waitFor('#table_users')
                    ->assertSee('Usuario registrado correctamente')
                    ->assertPathIs('/users');

        });
    }

    /**
     * @group userx
     */
    public function testUpdateUser(): void
    {
        $user = User::find(1);
        
        $this->browse(function (Browser $browser) use ($user) {
            $nameNew = "New name - ".fake()->name();
            $addressNew = "New address - ".fake()->address();
            $browser->loginAs($user)
                    ->visit(route('users.index'))
                    ->waitFor('#table_users')
                    ->with('#table_users', function (Browser $table) {
                        $table->click('a.edit');
                    })
                    ->whenAvailable('.modal', function (Browser $modal) use($nameNew,$addressNew) {
                        $modal->assertSee('Editar usuario')
                        ->value('#id_name', $nameNew)
                        ->select('#id_roles', range(1,3))
                        ->value('#id_address', $addressNew)
                        ->press('Guardar');
                    })
                    ->waitFor('#table_users')
                    ->assertSee('Usuario actualizado correctamente')
                    ->assertPathIs('/users');

        });
    }

    // public function testViewUser(): void
    // {
    //     $user = User::find(1);
        
    //     $this->browse(function (Browser $browser) use ($user) {
    //         $browser->loginAs($user)
    //                 ->visit(route('users.index'))
    //                 ->waitFor('#table_users')
    //                 ->with('#table_users', function (Browser $table) {
    //                     $table->click('a.view');
    //                 })
    //                 ->whenAvailable('.modal', function (Browser $modal) use($user) {
    //                     $modal->assertSee('Ver usuario')
    //                     ->assertValue('#id_name',$user->name)
    //                     ->press('Cerrar');
    //                 });

    //     });
    // }

    // public function testDeleteUser(): void
    // {
    //     $user = User::find(1);
        
    //     $this->browse(function (Browser $browser) use ($user) {
    //         $browser->loginAs($user)
    //                 ->visit(route('users.index'))
    //                 ->waitFor('#table_users')
    //                 ->with('#table_users', function (Browser $table) {
    //                     $table->click('a.delete');
    //                 })
    //                 ->whenAvailable('.modal', function (Browser $modal) {
    //                     $modal->assertSee('Eliminar usuario')
    //                     ->press('Eliminar');
    //                 })
    //                 ->waitFor('#table_users')
    //                 ->assertSee('Usuario eliminado correctamente')
    //                 ->assertPathIs('/users');

    //     });
    // }
}
