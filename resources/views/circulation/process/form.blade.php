<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card">

        {!! Form::model($mail, ['route' => ['circulation.processing.store', $mail->id], 'method' => 'patch']) !!}

        <div class="card-body">

                @include('circulation.process.fields',['mail'=>$mail])

        </div>

        <div class="card-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('mails.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
        </div>

        {!! Form::close() !!}

    </div>
</div>

