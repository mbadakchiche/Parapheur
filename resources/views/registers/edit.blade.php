<div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($register, ['route' => ['registers.update', $register->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('registers.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('registers.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

