<?php

namespace Tests\Feature;

use Tests\TestCase;

class RotaTest extends TestCase
{
    /**
     * Testa se as rotas de acesso e login estao respondendo corretamente
     */
    public function test_rotas_de_acesso_ao_sistema(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/login');
        $response->assertStatus(200);
    }
}
