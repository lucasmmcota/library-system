<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica a insercao de um usuario
     */
    public function test_inserir_usuario(): void
    {
        $user = (new UserTableSeeder())->run();

        $this->assertDatabaseCount('user', 1);
        $this->assertInstanceOf(User::class, $user);
    }
}
