<?php

namespace App\Http\Livewire;

use App\Models\Mail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Action;

class ActionsTable extends DataTableComponent
{
    use AuthorizesRequests;
    protected $model = Action::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $this->authorize('delete', Action::class);

        Action::find($id)->delete();
        Flash::success(__('messages.deleted', ['model' => __('models/actions.singular')]));
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make(__('models/actions.fields.name_ar'), "name_ar")
                ->sortable()
                ->searchable(),
            Column::make(__('models/actions.fields.name_en'), "name_en")
                ->sortable()
                ->searchable(),
            Column::make(__('crud.actions'), 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('actions.show', $row->id),
                        'editUrl' => route('actions.edit', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->name_en,
                    ])
                )
        ];
    }
}
