
<!-- Receivers Ids Multiple select -->
<div class="form-group col-sm-12">
    {!! Form::label('dossier_id', __('models/mails.fields.dossier_id').':') !!}
    {!! Form::select('dossier_id', $DossiersItems, null, ['class' => 'form-control custom-select receiversSelect select2-purple','style'=>"width: 100%"]) !!}
</div>



