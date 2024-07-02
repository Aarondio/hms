<?php

namespace App\Livewire\Inventory;

use App\Models\Inventory as Inventories;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class Index extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $name = "";
    public $expiry_date = "";
    public $quantity = "";

    public function render()
    {
        return view('livewire.inventory.index')->with([
            'total' => Inventories::count(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Inventories::query())
            ->columns([
                TextColumn::make('name')
                    ->label("Name")
                    ->searchable(),
                TextColumn::make('quantity')
                    ->label("Quantity"),
                TextColumn::make('expiry_date')
                    ->label("Expiry Date"),
            ])->actions([
                DeleteAction::make(),

            ]);
    }
    
    public function rules()
    {
        return [
            'name' => 'required|unique:inventories',
            'expiry_date' => 'required',
            'quantity' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => $this->name . " has already been added",
        ];
    }
    public function create()
    {
        $this->validate();
        Inventories::create($this->only([
            'name',
            'expiry_date',
            'quantity',
        ]));
        $this->reset();
        $this->redirect('inventory', navigate: true);
    }
}
