<!-- Service Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_id', __('models/parafeures.fields.service_id').':') !!}
    {!! Form::text('service_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/parafeures.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Abstract Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('abstract', __('models/parafeures.fields.abstract').':') !!}
    {!! Form::textarea('abstract', null, ['class' => 'form-control']) !!}
</div>

<!-- FILE Number -->
<div class="form-group col-sm-12">
    {!! Form::label('attachments[]', __('models/parafeures.fields.attachments').':') !!}
    {!! Form::file('attachments[]', ['class' => 'form-control','multiple'=>'true']) !!}
</div>
