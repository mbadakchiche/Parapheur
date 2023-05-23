<!-- Label Ar Field -->
<div class="col-sm-4">
    {!! Form::label('label_ar', __('models/dossiers.fields.label_ar').':') !!}
    <p>{{ $dossier->label_ar }}</p>
</div>

<!-- Label En Field -->
<div class="col-sm-4">
    {!! Form::label('label_en', __('models/dossiers.fields.label_en').':') !!}
    <p>{{ $dossier->label_en }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-4">
    {!! Form::label('user_id', __('models/dossiers.fields.user_id').':') !!}
    <p>{{ $dossier->incharge_by->name }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-4">
    {!! Form::label('status', __('models/dossiers.fields.status').':') !!}
    <p>{{ $dossier->status }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-4">
    {!! Form::label('description', __('models/dossiers.fields.description').':') !!}
    <p>{{ $dossier->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-4">
    {!! Form::label('created_at', __('models/dossiers.fields.created_at').':') !!}
    <p>{{ $dossier->created_at }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('mails', __('models/mails.fields.mails').':') !!}
    <p>
        @foreach ($dossier->mails as $mail )
            <a href="#popUp" href="#"
                class='btn btn-primary' onclick="loadeditform('{{ route('mails.show', $mail->id) }}', '  {{__('crud.show') . ' ' . $mail->objet }}')">
                <i class="fa fa-eye"></i>  @lang('models/mails.button.view')
            </a>
         @endforeach
    </p>
   
    
</div>
