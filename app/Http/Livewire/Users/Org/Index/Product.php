<?php

namespace App\Http\Livewire\Users\Org\Index;

use App\Models\Product as ModelsProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class Product extends DataTableComponent
{

    public function builder(): Builder
    {
        return ModelsProduct::available();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->setAdditionalSelects(['products.id as id']);
    }


    public function columns(): array
    {

        return [
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),

            Column::make('Umfang', 'scope')
                ->searchable()
                ->sortable(),

            Column::make('Unterrichtsart', 'lesson_type')
                ->searchable()
                ->sortable(),

            Column::make('Preis', 'price')
                ->searchable()
                ->sortable(),

            ButtonGroupColumn::make('Aktion')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit') // make() has no effect in this case but needs to be set anyway
                        ->title(fn ($row) => 'Bearbeiten')
                        ->location(fn($row) => route('organization.product.edit', $row->id))
                        ->attributes(function ($row) {
                            $hideClass = !Auth::user()->can('product:edit') ? 'd-none' : '';
                            return [
                                'class' => "btn {$hideClass} btn-sm btn-info",
                            ];
                        }),
                    LinkColumn::make('Delete') // make() has no effect in this case but needs to be set anyway
                        ->title(fn ($row) => 'Löschen')
                        ->location(fn($row) => "#")
                        ->attributes(function ($row) {
                            $hideClass = !Auth::user()->can('product:delete') ? 'd-none' : '';
                            return [
                                'class' => "btn {$hideClass} btn-sm btn-danger",
                                'wire:click' => "deleteConfirmation($row->id)"
                            ];
                        }),
                    ])
            ];
    }


    public function deleteConfirmation($record_id)
    {
        $this->emit('confirmDelete', $record_id);
        $this->emit('openModal', 'delete-modal');
    }

    public function delete(int $record_id)
    {
        dd($record_id);
        $record = ModelsProduct::find($record_id);
        $record->softDelete();

    }

}
