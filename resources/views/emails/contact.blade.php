@component('mail::message')
# New Contact

{{ $contact->full_name }} has made contact.

## Message
{{ $contact->message }}

## Email
<a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>

@isset($contact->phone)
## Phone
<a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
@endisset

@endcomponent
