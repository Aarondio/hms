<?php

namespace App\Livewire\Bill;

use App\Models\Bill;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Livewire\Component;

class Index extends Component implements HasForms,HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function render()
    {
        return view('livewire.bill.index');
    }

    public function table(Table $table):Table{
        return $table->query(Bill::query())
              ->columns([
                TextColumn::make('amount')->label('Amount Paid')->money(),
                TextColumn::make('user.name')->label('Patient'),
                TextColumn::make('created_at')->label('Payment Date')->date(),
        ]);
    }
}
