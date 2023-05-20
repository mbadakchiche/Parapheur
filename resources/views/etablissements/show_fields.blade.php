<!-- Name En Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', __('models/etablissements.fields.name_en').':') !!}
    <p>{{ $etablissement->name_en }}</p>
</div>

<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_ar', __('models/etablissements.fields.name_ar').':') !!}
    <p>{{ $etablissement->name_ar }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/etablissements.fields.created_at').':') !!}
    <p>{{ $etablissement->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/etablissements.fields.updated_at').':') !!}
    <p>{{ $etablissement->updated_at }}</p>
</div>

