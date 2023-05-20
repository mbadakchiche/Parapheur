<!-- Service OutBox register -->
<div class="form-group col-sm-6">
    {!! Form::label('register_id', __('models/circulations.fields.register_id').':') !!}
    {!! Form::select('register_id', $registersItems, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- record_number -->
<div class="form-group col-sm-6">
    {!! Form::label('record_number', __('models/circulations.fields.record_number').':') !!}
    {!! Form::text('record_number', null, ['class' => 'form-control']) !!}
</div>
<!-- record_number -->
<div class="form-group col-sm-6">
    {!! Form::label('reference_number', __('models/circulations.fields.reference_number').':') !!}
    {!! Form::text('reference_number', null, ['class' => 'form-control']) !!}
</div>


<!-- record_data -->
<div class="form-group col-sm-6">
    {!! Form::label('recorded_data', __('models/circulations.fields.record_data1').':') !!}
    {!! Form::text('recorded_data["expediter"]', null, ['class' => 'form-control']) !!}
</div>

<!-- record_data -->
<div class="form-group col-sm-6">
    {!! Form::label('recorded_data', __('models/circulations.fields.record_data2').':') !!}
    {!! Form::text('recorded_data["recorder_by"]', null, ['class' => 'form-control']) !!}
</div>

