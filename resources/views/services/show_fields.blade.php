<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_ar', __('models/services.fields.name_ar').':') !!}
    <p>{{ $service->name_ar }}</p>
</div>

<!-- Name En Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', __('models/services.fields.name_en').':') !!}
    <p>{{ $service->name_en }}</p>
</div>

<!-- Thumbnail Field -->
<div class="col-sm-12">
    {!! Form::label('thumbnail', __('models/services.fields.thumbnail').':') !!}
    <p>{{ $service->thumbnail }}</p>
</div>

<!-- Abr Latin Field -->
<div class="col-sm-12">
    {!! Form::label('abr_latin', __('models/services.fields.abr_latin').':') !!}
    <p>{{ $service->abr_latin }}</p>
</div>

<!-- Abr Ar Field -->
<div class="col-sm-12">
    {!! Form::label('abr_ar', __('models/services.fields.abr_ar').':') !!}
    <p>{{ $service->abr_ar }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/services.fields.created_at').':') !!}
    <p>{{ $service->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/services.fields.updated_at').':') !!}
    <p>{{ $service->updated_at }}</p>
</div>

