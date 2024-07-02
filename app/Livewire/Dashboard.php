<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\Department;
use App\Models\Notice;
use App\Models\Staff;
use App\Models\User;
use App\Models\Ward;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Filament\Tables\Actions\Action;

class Dashboard extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public function render()
    {
        return view('livewire.dashboard')->with([
            'total_staff' => Staff::count(),
            'total_doctors' => Staff::where('type', 'Doctor')->count(),
            'total_departments' => Department::count(),
            'total_wards' => Ward::count(),
            'total_patients' => User::count(),
            'income'=> Bill::sum('amount'),
            'notices' => Notice::where('is_active',1)->get(),

        ]);
    }

    public function table(Table $table): Table
    {
        return $table->query(User::query())
            ->columns([
                TextColumn::make('no'),
                TextColumn::make('name'),
                IconColumn::make('is_admitted')
                 ->label('Admitted')
                ->boolean(),
            ])
            ->emptyStateDescription('Once you add a new patient, they will appear here')
            ->emptyStateHeading('No patient')
            ->emptyStateActions([
                Action::make('create')
                ->label('New Patient')
                ->url(route('new-patient'))
                ->color('primary')
                ->icon('heroicon-m-plus')
                ->button(),
              ])
              ->actions([
                Action::make('View')->url(fn (User $user): string=>route('patient-record',$user))
              ]);
    }
}
