<!-- Thumbnail Field -->
<div class="form-group col-sm-12">
    <div class="avatar-upload">
        <div class="avatar-edit">
            <input type='file' id="thumbnail" name="thumbnail" accept=".png, .jpg, .jpeg" />
            <label for="thumbnail"></label>
        </div>
        <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=4);">
            </div>
        </div>
    </div>
</div>
<!-- Name En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_en', __('models/etablissements.fields.name_en').':') !!}
    {!! Form::text('name_en', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Name Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_ar', __('models/etablissements.fields.name_ar').':') !!}
    {!! Form::text('name_ar', null, ['class' => 'form-control']) !!}
</div>
