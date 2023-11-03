<?php

namespace Tests\Feature;

use App\Models\User\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_list_user(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $user->assignRole([1]);
        $this->actingAs($user);
        $response = $this->get(route('users.index'));
        $response->assertOk();
    }
    /**
     * A basic feature test example.
     */
    public function test_dataTable_user(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $this->actingAs($user);
        $response = $this->get(route('users.index'));

        $response->assertOk()
        ->assertSeeText('#', 'Nombre', 'Marca', 'Acciones');
    }
    /**
     * A basic feature test example.
     */
    public function test_view_user(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('users.show', [$user,'action' => 'view', 'modelTitle' => 'Usuario']));

        $response->assertOk();
        $response->assertSee($user->name);
    }

    public function test_edit_user(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $model = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('users.edit', ['user' => $model,'action' => 'edit', 'modelTitle' => 'Usuario']));

        $response->assertOk();
        $response->assertSee($model->name);
    }


    public function test_create_user(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $this->actingAs($user);
        $response = $this->get(route('users.create', ['action' => 'create', 'modelTitle' => 'Usuario']));

        $response->assertOk();
    }

    public function test_store_user(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $model = User::factory()->make();
        
        $values = $model->toArray();
        $values['roles'] = 1;
        $values['password'] = 'password';
        $values['password_confirmed'] = 'password';

        $this->actingAs($user);
        $response = $this->post(
            route('users.store'),
            $values
        );
        $response->assertOk();
        $response->assertJsonFragment(["message" => 'Usuario registrado correctamente']);
    }

    public function test_update_user(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $model = User::factory()->create();

        $values = $model->toArray();
        $new_name = 'New Test edit';
        $values['name'] = $new_name;
        $values['email'] = $model->email.'.co';
        $values['roles'] = 1;
        $this->actingAs($user);

        $response = $this->post(
            route('users.update', $user),
            $values
        );
        $response->assertOk();
        $response->assertJsonFragment(["message" => 'Usuario actualizado correctamente']);
    }

    public function test_delete_user(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $model = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('users.show', [$model, 'action' => 'delete', 'modelTitle' => 'Usuario']));

        $response->assertStatus(200);
        $response->assertSeeText($model->name);
    }

    public function test_destroy_user(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);

        $model = User::factory()->create();
        $this->actingAs($user);
        $response = $this->delete(route('users.destroy', $model));

        $response->assertOk()
            ->assertJsonFragment(["message" => 'Usuario eliminado correctamente']);
    }
}
