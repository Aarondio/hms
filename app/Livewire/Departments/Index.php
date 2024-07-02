<?php

namespace App\Livewire\Departments;

use App\Models\Department;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;



class Index extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $name = "";

    public function render()
    {
        return view('livewire.departments.index')->with([
            'total' => Department::count(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Department::query())
            ->columns([
                TextColumn::make('name')->searchable(),
                // IconColumn::make('is_active')
                //     ->label('Active')
                //     ->boolean()
                //     ,
                ToggleColumn::make('is_active')
                    ->label('Status'),
            ])->filters([
                Filter::make('is_active')
                    ->label('Status')
                    ->query(fn (Builder $query) => $query->where('is_active', true)),
                SelectFilter::make('is_active')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),
            ])
            ->actions([
                DeleteAction::make(),
                // Action::make('Inactive')
                //     ->action(function (Department $record) {
                //         $record->is_active = true;
                //         $record->save();
                //     })
                //     ->hidden(fn (Department $record): bool => $record->is_active),
                // Action::make('Active')
                //     ->action(function (Department $record) {
                //         $record->is_active = false;
                //         $record->save();
                //     })
                //     ->visible(fn (Department $record): bool => $record->is_active),
                    
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:departments'
        ];
    }
    public function messages(){
        return [
            'name.unique'=>$this->name. ' has already been added',
        ];
    }
    public function create()
    {
        $this->validate();
        Department::create($this->only([
            'name'
        ]));

        $this->redirect('departments',navigate:true);
    }
}
