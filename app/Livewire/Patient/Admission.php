<?php

namespace App\Livewire\Patient;

use App\Models\User;
use App\Models\Ward;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Attributes\Url;
use Livewire\Component;

class Admission extends Component implements HasForms
{
    use InteractsWithForms;

    #[Url]
    public $id;
    public $name;
    public User $user;

    public function mount()
    {
        $this->user = User::find($this->id);
    }

    public function render()
    {
        return view('livewire.patient.admission')->with([
            'patient' => User::find($this->id),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')->default($this->user->id),
                TextInput::make('name')->default("Name"),
                Select::make('id')
                    ->label('Room')
                    ->options(Ward::where('is_available',1)->pluck('no', 'id'))
                    ->searchable()
            ])->extraAttributes([
                'class' => ''
            ]);
    }


    public function create()
    {
    }
}
