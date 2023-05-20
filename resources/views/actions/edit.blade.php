<div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($action, ['route' => ['actions.update', $action->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('actions.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('actions.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

