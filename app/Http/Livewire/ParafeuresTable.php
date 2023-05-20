<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Parafeure;

class ParafeuresTable extends DataTableComponent
{
    protected $model = Parafeure::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Parafeure::find($id)->delete();
        Flash::success(__('messages.deleted', ['model' => __('models/parafeures.singular')]));
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {

        return [

            Column::make("Service", "initiated_by.name_ar")
                ->sortable()
                ->searchable(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make('Files', "id")
                ->format( function ($value, $row, Column $column){
                    $medias = $row->getMedia('attachments');
                    foreach ($medias as $media)
                        echo "<a href=".$media->getUrl()." class=\"btn btn-primary float-right mr-1\"> ".$media->basename." </a>";
                }
                )->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('parafeures.show', $row->id),
                        'editUrl' => route('parafeures.edit', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->title,
                    ])
                )
        ];
    }

    //TODO adding scope by service 'display only when service Id = to auth service_id'
    //TODO adding upload the signed file which be displayed to the assistant to send it
    //TODO the Initiator need too get a copy of the signed file
    //TODO Adding lang files
    //TODO Adding menu section and subsections,
    //TODO added filters
}
