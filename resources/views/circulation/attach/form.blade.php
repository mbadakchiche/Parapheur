<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card">

        {!! Form::model($mail, ['route' => ['circulation.attach.store', $mail->id], 'method' => 'patch', 'files'=>true]) !!}

        <div class="card-body">
            <div class="row">
                @include('circulation.attach.fields')
            </div>
        </div>

        <div class="card-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('mails.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
        </div>

        {!! Form::close() !!}

    </div>
</div>

