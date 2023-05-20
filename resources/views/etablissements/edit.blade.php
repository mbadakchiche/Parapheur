<div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($etablissement, ['route' => ['etablissements.update', $etablissement->id], 'method' => 'patch', 'files'=>true]) !!}

            <div class="card-body">
                <div class="row">
                    @include('etablissements.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('etablissements.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

