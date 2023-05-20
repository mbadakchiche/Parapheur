<div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($parafeure, ['route' => ['parafeures.update', $parafeure->id], 'method' => 'patch', 'files'=>true]) !!}

            <div class="card-body">
                <div class="row">
                    @include('parafeures.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('parafeures.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

