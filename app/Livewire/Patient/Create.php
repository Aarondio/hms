<?php

namespace App\Livewire\Patient;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;


class Create extends Component
{
    public $no;
    public $name;
    public $phone = "";
    public $email = "";
    public $address = "";
    public $password = "123456";


    public function mount()
    {
        $this->no = 'Wi' . rand(1000, 10000);
        $this->password = Hash::make($this->password);
    }
    public function render()
    {
        return view('livewire.patient.create');
    }

    public function rules()
    {
        return [
            'no' => 'required|unique:users',
            'name' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'no.unique' => 'The generated patient number has been registerd',
            'email.unique' => 'This email has already been registered',
            'phone.unique' => 'This phone number has already been registered'
        ];
    }

    public function create()
    {
        $this->validate();
        User::create($this->only([
            'no',
            'name',
            'phone',
            'email',
            'password',
            'address',
        ]));

        Notification::make()
            ->title('Patient created successfully')
            ->success()
            ->send();

        $this->redirect('/patients',navigate:true);
    }
}
