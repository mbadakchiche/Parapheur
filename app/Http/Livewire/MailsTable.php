<?php

namespace App\Http\Livewire;

use App\Models\Register;
use App\Models\Scopes\MailScope;
use App\Repositories\MailRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Mail;

class MailsTable extends DataTableComponent
{
    use AuthorizesRequests;

    protected $model = Mail::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {

        $this->authorize('delete', Mail::class);
        (new MailRepository())->find($id)->delete();
        Flash::success(__('messages.deleted', ['model' => __('models/mails.singular')]));
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return $this->getModel()::query()->with($this->getRelationships())->withoutGlobalScope(MailScope::class);
    }

    public function columns(): array
    {
        return [
            Column::make(__('models/mails.fields.id'), "id")
                ->sortable()
                ->searchable(),

            Column::make(__('models/mails.fields.objet'), "objet")
                ->sortable()
                ->searchable(),

            Column::make(__('models/mails.fields.created_at'), "created_at")
                ->sortable()
                ->searchable(),
            Column::make(__('crud.actions'), 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.mail', [
                        'showUrl' => route('mails.show', $row->id),
                        'recordUrl' => route('circulation.record', $row->id),
                        'sendUrl' => route('circulation.send', $row->id),
                        'processingUrl' => route('circulation.processing', $row->id),
                        'SendProcessingUrl' => route('circulation.SendProcessing', $row->id),
                        'editUrl' => route('mails.edit', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->objet,
                        'boolean' => ($row->registers()->exists())
                    ])
                )
        ];
    }
}
