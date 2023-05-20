
    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'services.store', 'files'=>true]) !!}

            <div class="card-body">

                <div class="row">
                    @include('services.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('services.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

