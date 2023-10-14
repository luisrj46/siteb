<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;
use Illuminate\Support\Str;

class LoginTest extends DuskTestCase
{
    // use DatabaseMigrations;
    /**
     * A Dusk test example.
     */
    public function testLogin(): void
    {
        $user = User::factory()->create();
 
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(route('login'))
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('#iniciar')
                    ->assertPathIs('/biomedicalEquipments')
                    ->assertSee($user->name);
        });
    }
    public function testLogout(): void
    {
        $user = User::factory()->create();
 
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit(route('dashboard'))
                    ->click('#dropdownMenuButtonUser')
                    ->clickLink('Salir')
                    ->assertPathIs('/login');
        });
    }


    
}
