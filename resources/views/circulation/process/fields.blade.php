<div class="row">
    <h2>{{__('models/circulations.fields.objet')}} : {{$mail->objet}} </h2>
    <h5>{{__('models/circulations.fields.ref')}} : {{$mail->ref}}</h5>
    <div class="col-12">
        <div class="row border-danger">
            <p class="col-6 badge-pill badge-info p-2  text-center">{{__('models/circulations.fields.arrived_at')}}
                : {{$mail->actualregister(Auth::user()->service_id)->first()->pivot->arrived_at}} </p>
            <p class="col-6 badge-pill badge-info p-2 text-center">{{__('models/circulations.fields.recorded_at')}}
                : {{$mail->actualregister(Auth::user()->service_id)->first()->pivot->recorded_at}}</p>
        </div>
    </div>

    <p>{{__('models/circulations.fields.body')}}:: {{$mail->body}}</p>
    <div class="col-sm-12">
        {!! Form::label('attachments', __('models/mails.fields.attachments').':') !!}
        @foreach($mail->getMedia('attachments') as $media )
            <a class="btn btn-dark" href="{!! $media->getUrl() !!}" target="_blank">{!! $media->filename !!} </a>
        @endforeach
    </div>
</div>

<div class="row border p-4">
    <h3 class="offset-3 col-7 badge-pill badge-warning p-1 text-center">{{__('models/circulations.fields.fiche')}} </h3>
    @foreach($actionItems as $action)
        <div class="form-group col-sm-3">
            {!! Form::label('processed_data', $action.':') !!}
        </div>
        <div class="form-group col-sm-3">
            {!! Form::select('processed_data['.$action.']', $ServiceItems, null, ['class' => 'form-control custom-select receiversSelect select2-purple','multiple'=>'true','style'=>"width: 100%"]) !!}
        </div>
    @endforeach
</div>


<div class="row p-4 mt-4">
    <div class="col-12">
        <div class="row">
            <!-- Default checked -->
            <div class="form-group col-6 custom-switch text-center">
                <h3>{{__('models/circulations.fields.response_needed')}}</h3>
                {!! Form::radio('response_needed', 1, ['class' => 'form-control']) !!}
                {!! Form::label('response_needed', __('models/circulations.fields.Oui').':') !!}
                {!! Form::radio('response_needed', 0, ['class' => 'form-control', 'checked'=>'true']) !!}
                {!! Form::label('response_needed', __('models/circulations.fields.Non').':') !!}
            </div>

            <div class="form-group col-6">
                {!! Form::label('response_deadline', __('models/circulations.fields.response_deadline').':') !!}
                {!! Form::date('response_deadline', null, ['class' => 'form-control']) !!}
            </div>
        </div>


        <div class="form-group col-sm-12">
            {!! Form::label('processed_orientations', __('models/circulations.fields.other').':') !!}
            {!! Form::textarea('processed_orientations', null, ['class' => 'form-control']) !!}
        </div>
    </div>

</div>




