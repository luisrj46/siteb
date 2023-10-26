<?php

namespace Tests\Feature;

use App\Models\User\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_list_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     */
    public function test_dataTable_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('users.index'));
        
        $response->assertStatus(200);
        
    }
    /**
     * A basic feature test example.
     */
    public function test_view_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('users.show',$user->id));
        
        $response->assertStatus(200);
        $response->assertSee($user->name);
        
    }
    
    public function test_edit_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('users.edit',$user->id));
        
        $response->assertStatus(200);
        $response->assertSee($user->name);
        
    }


    public function test_update_user(): void
    {
        $user = User::factory()->create();
        $user1 = User::factory()->create();
        $this->actingAs($user);

        $this->seed(RoleSeeder::class);
        
        $response = $this->withoutDeprecationHandling()->post(route('users.update',$user1),
        [
            'name' => 'luis manuel',
            'document'=>1223334444,
            'email' => 'ese1@gmail.com',
            'phone' => 234511111,
            'address' => "street 44",
            'roles' => '3',
            
        ]);
        $response->assertStatus(200);
    }

    public function test_delete_user(): void
    {
        $user = User::factory()->create();
        $userDelete = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('users.delete',$userDelete));
        
        $response->assertStatus(200);
        $response->assertSee($userDelete->name);
        
    }

    public function test_destroy_user(): void
    {
        $user = User::factory()->create();
        $userDestroy = User::factory()->create();
        $this->actingAs($user);
        $response = $this->delete(route('users.destroy',$userDestroy));
        
        $response->assertStatus(200);
        
    }

    public function test_create_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('users.create'));
        $response->assertStatus(200);
    }

    public function test_store_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post(route('users.store'),[
            'name' => fake()->name(),
            'document' => fake()->imei(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->e164PhoneNumber(),
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'password' => 'password', // password
            'password_confirmation' => 'password', // password
            'remember_token' => Str::random(10),
            'roles' => Role::get()->random()->id
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment(["message" => 'Usuario registrado correctamente']);
    }
    
}
