<?php

namespace App\Http\Livewire\Users\Org\Index;

use App\Enum\Facility\StatusEnum;
use App\Models\Facilty;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

class Facility extends DataTableComponent
{
    protected $listeners = ['recordDeletionConfirmed' => 'delete'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['facilties.id as id']);
    }

    public function builder(): Builder
    {
        return Facilty::available();
    }

    public function columns() : array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Status')
                ->searchable(),
            ButtonGroupColumn::make('Actions')
                ->buttons([
                    LinkColumn::make('Edit') // make() has no effect in this case but needs to be set anyway
                        ->title(fn ($row) => 'Eidt')
                        ->location(fn($row) => route('organization.facility.edit', $row))
                        ->attributes(function ($row) {
                            $hideClass = !Auth::user()->can('facility:edit') ? 'd-none' : '';
                            return [
                                'class' => "btn {$hideClass} btn-sm btn-info",
                            ];
                        }),
                    LinkColumn::make('Delete') // make() has no effect in this case but needs to be set anyway
                        ->title(fn ($row) => 'Delete')
                        ->location(fn($row) => "#")
                        ->attributes(function ($row) {
                            $hideClass = !Auth::user()->can('facility:delete') ? 'd-none' : '';
                            return [
                                'class' => "btn {$hideClass} btn-sm btn-danger",
                                'wire:click' => "deleteConfirmation({$row->id})"
                            ];
                        }),
                ]),
        ];
    }

    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Status')
                ->options(
                    [
                        StatusEnum::ACTIVE->value => StatusEnum::ACTIVE->name,
                        StatusEnum::ARRANGE_TELEPHONE_APPOINTMENT->value => StatusEnum::ARRANGE_TELEPHONE_APPOINTMENT->value,
                        StatusEnum::TELEPHONE_APPOINTMENT_ARRANGED->value => StatusEnum::TELEPHONE_APPOINTMENT_ARRANGED->value,
                        StatusEnum::INFORMATION_MATERIAL_IS_TO_BE_SENT->value => StatusEnum::TELEPHONE_APPOINTMENT_ARRANGED->value,
                        StatusEnum::INFORMATION_MATERIAL_HAS_BEEN_SENT->value => StatusEnum::TELEPHONE_APPOINTMENT_ARRANGED->value,
                    ]
                )
                ->filter(fn ($query, $value) => $query->whereIn('status', $value))
        ];
    }

    public function deleteConfirmation($record_id)
    {
        $this->emit('confirmDelete', $record_id);
        $this->emit('openModal', 'delete-modal');
    }

    public function delete(int $record_id)
    {

        $record = Facilty::find($record_id);
        $record->softDelete();

    }
}
