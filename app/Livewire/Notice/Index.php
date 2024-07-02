<?php

namespace App\Livewire\Notice;

use App\Models\Notice;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
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

class Index extends Component implements HasTable, HasForms
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $message = "";

    public function render()
    {
        return view('livewire.notice.index');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Notice::query())
            ->columns([
                TextColumn::make('message')->size('xs'),
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
                Action::make('Inactive')
                    ->action(function (Notice $record) {
                        $record->is_active = true;
                        $record->save();
                    })
                    ->hidden(fn (Notice $record): bool => $record->is_active),
                Action::make('Active')
                    ->action(function (Notice $record) {
                        $record->is_active = false;
                        $record->save();
                    })
                    ->visible(fn (Notice $record): bool => $record->is_active),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->delete()),
                    // BulkAction::make('forceDelete')
                    //     ->requiresConfirmation()
                    //     ->action(fn (Collection $records) => $records->each->forceDelete()),
                ]),

            ])
            ->emptyStateHeading('No announcement has been added')
            ->emptyStateDescription('Once you add a notice it will appear hear')
            ->emptyStateIcon('heroicon-o-bell');
    }

    public function rules()
    {
        return [
            'message' => 'required'
        ];
    }

    public function create()
    {
        $this->validate();
        Notice::create($this->only([
            'message'
        ]));
        $this->redirect('/notice', navigate: true);
    }
}
