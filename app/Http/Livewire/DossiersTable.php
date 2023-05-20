<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Dossier;

class DossiersTable extends DataTableComponent
{
    use AuthorizesRequests;
    protected $model = Dossier::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $this->authorize('delete', Dossier::class);

        Dossier::find($id)->delete();
        Flash::success(__('messages.deleted', ['model' => __('models/dossiers.singular')]));
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        $title = 'label_'.\App::getLocale();
        return [
            Column::make(__('models/dossiers.fields.label_ar'), "label_ar")
                ->sortable()
                ->searchable(),
            Column::make(__('models/dossiers.fields.user_id'), "incharge_by.name")
                ->sortable()
                ->searchable(),
            Column::make(__('models/dossiers.fields.status'), "status")
                ->format(
                    function($value,$row, Column $column) {
                        $html = "<span class='badge-pill ".$row->bgColors[app()->getLocale()][$row->status]." p-2'>" .  $row->status . "</span>";
                        echo $html;
                    }
                )
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.dossier', [
                        'showUrl' => route('dossiers.show', $row->id),
                        'editUrl' => route('dossiers.edit', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->$title,
                    ])
                )
        ];
    }
}
