<!-- Label Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label_ar', __('models/registers.fields.label_ar').':') !!}
    {!! Form::text('label_ar', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Label En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label_en', __('models/registers.fields.label_en').':') !!}
    {!! Form::text('label_en', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('year', __('models/registers.fields.year').':') !!}
    {!! Form::text('year', null, ['class' => 'form-control','id'=>'year']) !!}
</div>


<!-- Service Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_id', __('models/registers.fields.service_id').':') !!}
    {!! Form::select('service_id', $ServiceItems, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', __('models/registers.fields.type').':') !!}
    {!! Form::select('type', $typeItems, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', __('models/registers.fields.type').':') !!}
    {!! Form::select('category', $categoryItems, null, ['class' => 'form-control custom-select']) !!}
</div>



<!-- Starting Nbr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('starting_nbr', __('models/registers.fields.starting_nbr').':') !!}
    {!! Form::number('starting_nbr', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Licence Field -->
<div class="form-group col-sm-6">
    {!! Form::label('licence', __('models/registers.fields.licence').':') !!}
    {!! Form::text('licence', null, ['class' => 'form-control', 'required']) !!}
</div>
