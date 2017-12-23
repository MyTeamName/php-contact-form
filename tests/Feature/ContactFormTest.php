<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contact;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function getContactData() : array
    {
        $this->refreshApplication();
        // https://stackoverflow.com/a/26774924/4233593

        return [
            'Jeff Puckett' => [[
                'full_name' => 'Jeff Puckett',
                'email' => 'jeff@jeffpuckett.com',
                'message' => 'I love writing code to make things better.',
                'phone' => '678 321 Puck', // (678) 321-7825
            ]],
            'factory' => [
                factory(Contact::class)->make()->toArray(),
            ],
        ];
    }

    /**
     * @dataProvider getContactData
     */
    public function test_saves_contact_form_to_database(array $data)
    {
        $this->post('/contact', $data)->assertStatus(201);

        $this->assertDatabaseHas('contacts', $data);
    }

    public function test_vendor_phone_validator()
    {
        $data = [
            'full_name' => 'Jeff Puckett',
            'email' => 'jeff@jeffpuckett.com',
            'message' => 'I love writing code to make the world a bit better.',
            'phone' => 'faux number',
        ];

        $this->post('/contact', $data)->assertSessionHasErrors(['phone']);

        $this->assertDatabaseMissing('contacts', $data);
    }
}
