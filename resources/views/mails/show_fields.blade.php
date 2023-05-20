
<h2>{{__('models/circulations.fields.objet')}} : {{$data['mail']->objet}} <p class="mb-5 badge-pill badge-danger p-2 text-center float-right">{{__('models/circulations.fields.ref')}}
        : {{$data['mail']->ref}}</p></h2>
<div class="p-2">


    <div class="row mb-4">


        <div class="col-6 badge-pill badge-info p-2  text-center">{{__('models/circulations.fields.arrived_at')}}
            : {{$data['mail']->registers()->first()->pivot->arrived_at ?? ''}} </div>
        <div class="col-6 badge-pill badge-info p-2 text-center">{{__('models/circulations.fields.recorded_at')}}
            : {{$data['mail']->registers()->first()->pivot->recorded_at ?? ''}}</div>
        </div>

        <div class="col-12">
            <h5>
                {{__('models/circulations.fields.body')}}:
            </h5><br>
            <p> {{$data['mail']->body ?? ''}}</p>
        </div>
</div>
<br/>
<div class="row p-4">
    @if(!($data['pivot']->pivot->response_needed <= now()))
        {!! Form::label('receiver_id', __('messages.response_needed').':') !!}
       {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $data['pivot']->pivot->response_deadline)->diffForHumans()}}

        <span class="badge badge-warning"> {{$data['pivot']->pivot->response_deadline}}</span>
    @endif
    @if(!empty($data['pivot']->pivot->orientation_data ?? ''))
        <!-- Receivers Ids Multiple select -->
        <div class="form-group col-sm-12">
            {!! Form::label('receiver_id', __('models/circulations.fields.orientations').':') !!}
            <div class="text-danger">
                <p>{!! __('messages.send_to') !!} : </p>
                <ul>
                    @foreach($data['receivers'] as $key =>$value)
                        <li> {{$value}} : {{$key}} </li>
                    @endforeach
                </ul>
            </div>
            {!! Form::label('receiver_id', __('models/circulations.fields.O_Orientations').':') !!}
            <div class="text-danger">
                <p>{!! $data['orientations'] ?? ''!!}  </p>
            </div>
        </div>
    @endif
</div>
<!-- Body Field -->
<div class="col-sm-12">
    {!! Form::label('attachments', __('models/mails.fields.attachments').':') !!}
    @foreach($data['mail']->getMedia('attachments') as $media )
        <a class="btn btn-dark" href="{!! $media->getUrl() !!}" target="_blank">{!! $media->filename !!} </a>
    @endforeach
</div>
</div>
