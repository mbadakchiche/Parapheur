<!-- Label Ar Field -->
<div class="col-sm-12">
    {!! Form::label('label_ar', __('models/dossiers.fields.label_ar').':') !!}
    <p>{{ $dossier->label_ar }}</p>
</div>

<!-- Label En Field -->
<div class="col-sm-12">
    {!! Form::label('label_en', __('models/dossiers.fields.label_en').':') !!}
    <p>{{ $dossier->label_en }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/dossiers.fields.user_id').':') !!}
    <p>{{ $dossier->user_id }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', __('models/dossiers.fields.status').':') !!}
    <p>{{ $dossier->status }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/dossiers.fields.description').':') !!}
    <p>{{ $dossier->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/dossiers.fields.created_at').':') !!}
    <p>{{ $dossier->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/dossiers.fields.updated_at').':') !!}
    <p>{{ $dossier->updated_at }}</p>
</div>

