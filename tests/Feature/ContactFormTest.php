<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactFormTest extends TestCase
{
    public function test_saves_contact_form_to_database()
    {
        $data = [
            'full_name' => 'Jeff Puckett',
            'email' => 'jeff@jeffpuckett.com',
            'message' => 'I love writing code to make the world a bit better.',
            'phone' => '(678) 321-7825', // 678 321 Puck
        ];

        $this->post('/contact', $data)->assertSuccessful();

        $this->assertDatabaseHas('contacts', $data);
    }
}
