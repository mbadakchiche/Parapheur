 <div class="content px-3">

        @@include('adminlte-templates::common.errors')

        <div class="card">

            @{!! Form::model(${{ $config->modelNames->camel }}, ['route' => ['{{ $config->prefixes->getRoutePrefixWith('.') }}{{ $config->modelNames->camelPlural }}.update', ${{ $config->modelNames->camel }}->{{ $config->primaryName }}], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @@include('{{ $config->prefixes->getViewPrefixForInclude() }}{{ $config->modelNames->snakePlural }}.fields')
                </div>
            </div>

            <div class="card-footer">
                @{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="@{{ route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}.index') }}" class="btn btn-default">@if($config->options->localized) @@lang('crud.cancel') @else Cancel @endif</a>
            </div>

            @{!! Form::close() !!}

        </div>
    </div>

