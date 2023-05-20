<?php

namespace App\Http\Livewire\details;

use App\Models\Mail;
use App\Models\Register;
use App\Models\Scopes\ServiceScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class outcomeMailsTable extends DataTableComponent
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
        $this->setFilterLayoutSlideDown();    }

    public function filters(): array
    {
        return [
            SelectFilter::make(__('models/registers.fields.category'))
                ->options(
                   (new Register())->types[app()->getLocale()]
                )
                ->filter(function(Builder $builder, string $value) {
                    $builder->outcomeByType(auth()->user()->service_id, $value);
                }),
        ];
    }

    public function builder(): Builder
    {
        return $this->getModel()::query()
                     ->join('mail_register','mails.id', '='  ,'mail_register.mail_id')
                     ->join('registers','registers.id', '=', 'mail_register.register_id')
                     ->join('services','services.id', '=', 'mail_register.receiver_id')
                     ->select('mails.objet',
                              'mail_register.*',
                              'registers.category',
                              'services.name_ar',
                              'services.name_ar',
                              'services.name_en',
                              'mails.id as mail_number',
                              'services.id as service_number')
                     ->where('mail_register.sender_id',auth()->user()->service_id)
                     ->where('registers.category',2)
                    ->orderBy('mail_register.created_at', 'DESC')
                     ->withOutGlobalScope(ServiceScope::class);
    }

    public function columns(): array
    {
        return [
            Column::make(__('models/Mails.fields.id'), "id")
                ->searchable(),
            Column::make(__('models/circulations.fields.sent_number'), "id")
                ->format( function ($value, $row, Column $column){
                            echo $row->sent_number;
                        }
                )->searchable(),

            Column::make(__('models/services.fields.name_ar'), "id")
                ->format( function ($value, $row, Column $column){
                    $recivers =  $row->name_ar;
                    echo $recivers;
                }
                )->searchable(),

            Column::make(__('models/mails.fields.objet'), "objet")
                ->sortable()
                ->searchable(),

            Column::make(__('models/mails.fields.created_at'), "created_at")
                ->searchable(),


            Column::make(__('crud.actions'), 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.details.outcomeMails', [
                        'showUrl' => route('mails.show', $row->id),
                        'attachUrl'=>route('mails.attach', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->objet,
                    ])
                )
        ];
    }
}
