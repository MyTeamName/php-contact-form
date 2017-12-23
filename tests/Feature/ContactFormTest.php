<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_saves_contact_form_to_database()
    {
        $data = [
            'full_name' => 'Jeff Puckett',
            'email' => 'jeff@jeffpuckett.com',
            'message' => 'I love writing code to make the world a bit better.',
            'phone' => '678 321 Puck', // (678) 321-7825
        ];

        $this->post('/contact', $data)->assertStatus(201);

        $this->assertDatabaseHas('contacts', $data);
    }

    public function test_vendor_phone_validator()
    {
        $data = [
            'full_name' => 'Jeff Puckett',
            'email' => 'jeff@jeffpuckett.com',
            'message' => 'I love writing code to make the world a bit better.',
            'phone' => 'this is not a phone number',
        ];

        $this->post('/contact', $data)->assertSessionHasErrors(['phone']);

        $this->assertDatabaseMissing('contacts', $data);
    }
}
