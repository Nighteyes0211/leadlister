<?php

namespace App\Http\Livewire\Users\Org\Index;

use App\Enum\Appointment\StatusEnum;
use App\Models\Appointment as ModelsAppointment;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class Appointment extends DataTableComponent
{

    public $model = ModelsAppointment::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['appointments.id as id']);
        $this->setDefaultSort('start_date', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make('Titel', 'name')
                ->searchable()
                ->sortable(),
            Column::make('Startzeit', 'start_date')
                ->format(fn ($value, $row, Column $column) => parseDate($value, 'M j, Y h:i A'))
                ->searchable()
                ->sortable(),
            Column::make('Endzeit', 'end_date')
                ->format(fn ($value, $row, Column $column) => parseDate($value, 'M j, Y h:i A'))
                ->searchable()
                ->sortable(),
            Column::make('Kontakt', 'contact_id')
                ->format(function ($value, $row, Column $column) {
                    $name = $row->contact?->fullName();
                    $link = $row->contact ? route('organization.contact.edit', $row->contact) : '#';
                    return "<a class='text-primary' href='$link'>$name</a>";
                })
                ->html()
                ->searchable()
                ->sortable(),
            Column::make('Position', 'contact_id')
                ->format(fn ($value, $row, Column $column) => $row->contact?->position?->name)
                ->searchable()
                ->sortable(),
            Column::make('TelNr', 'contact_id')
                ->format(fn ($value, $row, Column $column) => $row->contact?->mobile)
                ->searchable()
                ->sortable(),
            Column::make('Einrichtungen', 'contact_id')
                ->format(fn ($value, $row, Column $column) => $row->contact?->facilities->pluck('name')->join(', '))
                ->searchable()
                ->sortable(),
            Column::make('Status', 'status')
                ->format(function ($value, $row, Column $column) {
                    $status = StatusEnum::tryFrom($value);
                    $color = $status->color();
                    $label = $status->label();
                    return "<span class='badge badge-$color'>$label</span>";
                })
                ->html()
                ->searchable()
                ->sortable(),

            ButtonGroupColumn::make('Aktionen')
                ->buttons([
                    LinkColumn::make('Edit') // make() has no effect in this case but needs to be set anyway
                        ->title(fn ($row) => 'Bearbeiten')
                        ->location(fn($row) => route('organization.appointment.edit', $row))
                        ->attributes(function ($row) {
                            return [
                                'class' => "btn btn-sm btn-info",
                            ];
                        }),
                ]),

        ];
    }

}
