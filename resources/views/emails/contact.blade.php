@component('mail::message')
# New Contact

{{ $contact->full_name }} has made contact.

## Message
{{ $contact->message }}

## Email
<a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>

@isset($contact->phone)
## Phone
{{ $contact->phone }}
@endisset

@endcomponent
