<?php

namespace App\Livewire\Staff;
use App\Models\Staff as AllStaff;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class Staff extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function render()
    {
        return view('livewire.staff.staff')->with([
            'total'=>AllStaff::count(),
        ]);
    }

    public function table(Table $table):Table{
        return $table
        ->query(AllStaff::query())
        ->columns([
            TextColumn::make('emp_id'),
            TextColumn::make('name'),
            TextColumn::make('email'),
            TextColumn::make('phone'),
            TextColumn::make('type')->searchable(),
        ])->actions([
            DeleteAction::make(),
       
        ])
    
        ->emptyStateHeading('No staff has been registered')
        ->emptyStateDescription('Once you add a staff, it will appear here.')
        ->emptyStateIcon('heroicon-o-user-minus')
        ->emptyStateActions([
            Action::make('create')
                ->label('New Staff')
                ->url(route('new-staff'))
                ->color('primary')
                ->icon('heroicon-m-plus')
                ->button(),
        ]);
        
        ;
    }
}
