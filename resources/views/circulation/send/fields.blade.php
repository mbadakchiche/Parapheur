<!-- Service OutBox register -->
<div class="form-group col-sm-6">
    {!! Form::label('register_id', __('models/circulations.fields.register_id').':') !!}
    {!! Form::select('register_id', $registersItems, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Sent Number -->
<div class="form-group col-sm-6">
    {!! Form::label('sent_number', __('models/circulations.fields.sent_number').':') !!}
    {!! Form::text('sent_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Receivers Ids Multiple select -->
<div class="form-group col-sm-12">
    {!! Form::label('receiver_id', __('models/circulations.fields.receiver_id').':') !!}
    {!! Form::select('receiver_id[]', $ServiceItems, null, ['class' => 'form-control custom-select receiversSelect select2-purple','multiple'=>'true','style'=>"width: 100%"]) !!}
</div>


<!-- Sent Number -->
<div class="form-group col-sm-12">
    {!! Form::label('other', __('models/circulations.fields.other').':') !!}
    {!! Form::textarea('other', null, ['class' => 'form-control']) !!}
</div>



