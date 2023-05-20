
    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @@include('{{ $config->prefixes->getViewPrefixForInclude() }}{{ $config->modelNames->snakePlural }}.show_fields')
                </div>
            </div>
        </div>
    </div>

