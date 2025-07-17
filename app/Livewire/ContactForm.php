<?php

namespace App\Livewire;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Livewire\Component;

class ContactForm extends Component
{
    public $name, $email, $phone, $city, $country, $subject, $message;
    public function submit()
    {
        $validated = $this->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'city' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:1000',
        ]);

        Contact::create($validated);
        session()->flash('message', 'Thank you for contacting us. We will contact you shortly.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
