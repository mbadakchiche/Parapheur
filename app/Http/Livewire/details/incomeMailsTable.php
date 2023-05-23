<?php

namespace App\Http\Livewire\details;

use App\Models\Mail;
use App\Models\Register;
use App\Models\Scopes\MailScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class incomeMailsTable extends DataTableComponent
{
    use AuthorizesRequests;

    protected $model = Mail::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $this->authorize('delete', Mail::class);
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
                    ->with($this->getRelationships())
                    ->income(\Auth::user()->service_id);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make(__('models/registers.fields.category'))
                ->options(
                    (new Register())->types[app()->getLocale()]
                )
                ->filter(function(Builder $builder, string $value) {
                    $builder->incomeByType(auth()->user()->service_id, $value);
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make(__('models/mails.fields.id'), "id")
                ->sortable()
                ->searchable(),
            Column::make(__('models/mails.fields.ref'), "ref")
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
                    fn($value, $row, Column $column) => view('common.livewire-tables.details.incomeMails', [
                        'showUrl' => route('mails.show', $row->id),
                        'attachUrl'=>route('mails.attach', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->objet,
                    ])
                )
        ];
    }
}
