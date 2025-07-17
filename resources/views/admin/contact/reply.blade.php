<p>Dear {{ $contact->name }},</p>

<p>Thank you for reaching out to us. Here is our reply:</p>

<blockquote>
    {{ $reply }}
</blockquote>

<p>If you have more questions, feel free to reply to this email.</p>

<p>Best regards,<br>{{ config('app.name') }} Support</p>
