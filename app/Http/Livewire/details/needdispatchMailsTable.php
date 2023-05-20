<?php

namespace App\Http\Livewire\details;

use App\Models\Mail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class needdispatchMailsTable extends DataTableComponent
{
    use AuthorizesRequests;

    protected $model = Mail::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $this->authorize('ViewAny', Mail::class);
        Mail::find($id)->delete();
        Flash::success(__('messages.deleted', ['model' => __('models/mails.singular')]));
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return $this->getModel()::query()
                    ->needdispatch(\Auth::user()->service_id)
                    ->with($this->getRelationships());
    }

    public function columns(): array
    {
        return [
            Column::make(__('models/mails.fields.id'), "id")
                ->sortable()
                ->searchable(),
            Column::make(__('models/circulations.fields.record_number'), "ref")
                ->format( function ($value, $row, Column $column){
                            echo $row->actualregister(\Auth::user()->service_id)->first()->pivot->record_number;
                        }
                )->searchable(),

            Column::make(__('models/mails.fields.objet'), "objet")
                ->sortable()
                ->searchable(),

            Column::make(__('models/mails.fields.created_at'), "created_at")
                ->sortable()
                ->searchable(),


            Column::make(__('crud.actions'), 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.details.needdispatchMails', [
                        'showUrl' => route('mails.show', $row->id),
                        'SendProcessingUrl' => route('circulation.SendProcessing', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->objet,
                    ])
                )
        ];
    }
}
