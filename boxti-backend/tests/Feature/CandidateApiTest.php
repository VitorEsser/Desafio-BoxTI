<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CandidateApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_candidates()
    {
        $this->json('GET', route('candidates.index'))
            ->assertStatus(200);
    }

    public function test_can_create_candidate()
    {
        $formData = [
            'name'=>'Letícia Silva',
            'cpf'=>'77904606097',
            'email'=>'leticia@gmail.com',
            'date_birth'=>'22/08/1996',
            'address'=>'Rua São Paulo, 367',
            'stacks'=>['Python','Java','PHP','Javascript']
        ];

        $this->withoutExceptionHandling();

        $this->json('POST', route('candidates.store'), $formData)
            ->assertStatus(200);
    }
}
