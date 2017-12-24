<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;

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
        Mail::fake();

        $this->post('/contacts', $data)->assertStatus(201);

        $this->assertDatabaseHas('contacts', $data);

        Mail::assertSent(NewContact::class, function ($mail) use ($data) {
            return $mail->hasTo('guy-smiley@example.com') &&
                $mail->contact->full_name === $data['full_name'] &&
                $mail->contact->message === $data['message'] &&
                $mail->contact->email === $data['email'] &&
                $mail->contact->phone === $data['phone'];
        });
    }

    public function test_vendor_phone_validator()
    {
        $data = [
            'full_name' => 'Jeff Puckett',
            'email' => 'jeff@jeffpuckett.com',
            'message' => 'I love writing code to make the world a bit better.',
            'phone' => 'faux number',
        ];

        $this->post('/contacts', $data)->assertSessionHasErrors(['phone']);

        $this->assertDatabaseMissing('contacts', $data);
    }
}
