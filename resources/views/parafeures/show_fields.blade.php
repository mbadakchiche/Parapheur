<!-- Service Id Field -->
<div class="col-sm-12">
    {!! Form::label('service_id', __('models/parafeures.fields.service_id').':') !!}
    <p>{{ $parafeure->service_id }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', __('models/parafeures.fields.title').':') !!}
    <p>{{ $parafeure->title }}</p>
</div>

<!-- Abstract Field -->
<div class="col-sm-12">
    {!! Form::label('abstract', __('models/parafeures.fields.abstract').':') !!}
    <p>{{ $parafeure->abstract }}</p>
</div>

<!-- Signed Field -->
<div class="col-sm-12">
    {!! Form::label('signed', __('models/parafeures.fields.signed').':') !!}
    <p>{{ $parafeure->signed }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/parafeures.fields.created_at').':') !!}
    <p>{{ $parafeure->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/parafeures.fields.updated_at').':') !!}
    <p>{{ $parafeure->updated_at }}</p>
</div>

