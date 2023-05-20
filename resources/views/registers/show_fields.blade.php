<!-- Label Ar Field -->
<div class="col-sm-12">
    {!! Form::label('label_ar', __('models/registers.fields.label_ar').':') !!}
    <p>{{ $register->label_ar }}</p>
</div>

<!-- Label En Field -->
<div class="col-sm-12">
    {!! Form::label('label_en', __('models/registers.fields.label_en').':') !!}
    <p>{{ $register->label_en }}</p>
</div>

<!-- Year Field -->
<div class="col-sm-12">
    {!! Form::label('year', __('models/registers.fields.year').':') !!}
    <p>{{ $register->year }}</p>
</div>

<!-- Service Id Field -->
<div class="col-sm-12">
    {!! Form::label('service_id', __('models/registers.fields.service_id').':') !!}
    <p>{{ $register->service_id }}</p>
</div>

<!-- Starting Nbr Field -->
<div class="col-sm-12">
    {!! Form::label('starting_nbr', __('models/registers.fields.starting_nbr').':') !!}
    <p>{{ $register->starting_nbr }}</p>
</div>

<!-- Licence Field -->
<div class="col-sm-12">
    {!! Form::label('licence', __('models/registers.fields.licence').':') !!}
    <p>{{ $register->licence }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/registers.fields.created_at').':') !!}
    <p>{{ $register->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/registers.fields.updated_at').':') !!}
    <p>{{ $register->updated_at }}</p>
</div>

