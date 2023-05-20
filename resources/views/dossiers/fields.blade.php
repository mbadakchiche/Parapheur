<!-- Label Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label_ar', __('models/dossiers.fields.label_ar').':') !!}
    {!! Form::text('label_ar', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Label En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label_en', __('models/dossiers.fields.label_en').':') !!}
    {!! Form::text('label_en', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/dossiers.fields.user_id').':') !!}
    {!! Form::select('user_id',  $usersItems, null, ['class' => 'form-control custom-select receiversSelect select2-purple','style'=>"width: 100%"]) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('models/dossiers.fields.status').':') !!}
    {!! Form::select('status', $StatusItems, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', __('models/dossiers.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
</div>
