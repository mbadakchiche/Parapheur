<!-- Objet Field -->
<div class="form-group col-sm-6">
    {!! Form::label('objet', __('models/mails.fields.objet').':') !!}
    {!! Form::text('objet', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Ref Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ref', __('models/mails.fields.ref').':') !!}
    {!! Form::text('ref', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('body', __('models/mails.fields.body').':') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- FILE Number -->
<div class="form-group col-sm-12">
    {!! Form::label('attachments[]', __('models/circulations.fields.attachments').':') !!}
    {!! Form::file('attachments[]', ['class' => 'form-control','multiple'=>'true']) !!}
</div>
