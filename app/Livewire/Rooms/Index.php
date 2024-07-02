<?php

namespace App\Livewire\Rooms;

use App\Models\Ward;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
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
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component implements HasForms, HasTable
{

    use InteractsWithTable;
    use InteractsWithForms;

    public $no = "";
    public $capacity = "";
    public $floor = "";
    public $type = "";
    public $is_available;

    public function table(Table $table): Table
    {
        return $table
            ->query(Ward::query())
            ->columns([
                TextColumn::make('no')
                    ->label('Room No.')
                    ->sortable(),
                TextColumn::make('capacity')->searchable(),
                TextColumn::make('sick_person')->label('Occupied'),
                TextColumn::make('type')->searchable(),
                TextColumn::make('status')->searchable()->color('primary')->fontFamily('serif'),
                // IconColumn::make('is_available')->boolean(),
                // ToggleColumn::make('is_available')
                //     ->label('Status'),
            ])
            ->filters([
                Filter::make('status')
                    ->query(fn (Builder $query) => $query->where('status', 'available')),
                SelectFilter::make('status')
                ->label('Availability')
                    ->options([
                        'available' => 'Available',
                        'unavailable' => 'Unavailable',

                    ]),
            ])
            ->actions([
                DeleteAction::make(),
           
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->delete()),
                    BulkAction::make('forceDelete')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->forceDelete()),
                ]),

            ]);
    }

    public function render()
    {
        return view('livewire.rooms.index')->with([
            'total_wards' => Ward::count(),
            'wards' => Ward::all(),
        ]);
    }

    public function rules()
    {
        return [
            'no' => 'required|unique:wards',
            'capacity' => 'required',
            'type' => 'required',
        ];
    }
    public function messages(){
        return [
            'no.unique'=>'The room number ('. $this->no.') has been added already'
        ];
    }
    public function create()
    {
        // dd("hello");
        $this->validate();
        Ward::create($this->only([
            'no',
            'capacity',
            'type',
        ]));
        $this->redirect('/rooms');
    }
}
