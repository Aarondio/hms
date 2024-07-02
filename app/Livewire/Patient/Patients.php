<?php

namespace App\Livewire\Patient;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Patients extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    public function render()
    {
        return view('livewire.patient.patients')->with([
            'total' => User::count(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                // Split::make([
                TextColumn::make('no')
                    ->searchable()
                    ->label('Number'),
                TextColumn::make('name')
                    ->searchable()
                    ->label('Full name'),
                TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),
                TextColumn::make('phone')->searchable(),
                // ToggleColumn::make('is_admitted')
                //     ->label('Admitted'),
                IconColumn::make('is_admitted')
                    ->label('Admitted')
                    ->sortable()
                    ->boolean(),
                // ])

            ])
            ->actions([
                // Action::make('delete')
                //     ->requiresConfirmation()
                //     ->action(fn (User $record) => $record->delete()),
                // Action::make('Admit')
                //     ->url(fn (User $record): string => route('admit', $record)),
                Action::make('View')->url(fn (User $user): string=>route('patient-record',$user))
            ])->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->delete()),
                   
                ])->label('Delete'),

            ])->emptyStateHeading('No patient has been added')
             ->emptyStateDescription('Once you add a patient, They will appear here')
             ->emptyStateIcon('heroicon-o-user-minus')
             ->emptyStateActions([
                Action::make('create')
                    ->label('New Patient')
                    ->url(route('new-patient'))
                    ->color('primary')
                    ->icon('heroicon-m-plus')
                    ->button(),
            ]);
             ;
    }
}
