<?php

namespace App\Livewire\Staff;

use App\Models\Staff as AllStaff;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Search extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    
    #[URL(keep:true)]
    public $type;

    public function render()
    {
        return view('livewire.staff.search')->with([
            'total'=>AllStaff::count(),
        ]);
    }

    public function table(Table $table):Table{
        return $table
        ->query(AllStaff::query()->where('type',$this->type))
        ->columns([
            TextColumn::make('emp_id'),
            TextColumn::make('name'),
            TextColumn::make('email'),
            TextColumn::make('phone'),
            TextColumn::make('type')->searchable(),
        ])->actions([
            DeleteAction::make(),
       
        ])->emptyStateHeading('No '. $this->type .' has been added');
    }
}
