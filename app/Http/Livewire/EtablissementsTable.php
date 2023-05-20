<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Etablissement;

class EtablissementsTable extends DataTableComponent
{use AuthorizesRequests;
    protected $model = Etablissement::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $this->authorize('delete', Etablissement::class);

        Etablissement::find($id)->delete();
        Flash::success(__('messages.deleted', ['model' => __('models/etablissements.singular')]));
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("", "id") ->format(
                fn($value, $row, Column $column) => view('common.livewire-tables.image', [
                    'path'=>$row->getMedia('thumbnail')
                ])
            ),
            Column::make(__('models/etablissements.fields.name_en'), "name_en")
                ->sortable()
                ->searchable(),
            Column::make(__('models/etablissements.fields.name_ar'), "name_ar")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('etablissements.show', $row->id),
                        'editUrl' => route('etablissements.edit', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->name_en,
                        'path'=>$row->getMedia('thumbnail')
                    ])
                )
        ];
    }
}
