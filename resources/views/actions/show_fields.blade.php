<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_ar', __('models/actions.fields.name_ar').':') !!}
    <p>{{ $action->name_ar }}</p>
</div>

<!-- Name En Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', __('models/actions.fields.name_en').':') !!}
    <p>{{ $action->name_en }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/actions.fields.created_at').':') !!}
    <p>{{ $action->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/actions.fields.updated_at').':') !!}
    <p>{{ $action->updated_at }}</p>
</div>

