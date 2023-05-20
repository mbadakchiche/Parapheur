@@extends('layouts.app')

@@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
@if($config->options->localized)
                    <h1>@@lang('models/{{ $config->modelNames->camelPlural }}.plural')</h1>
@else
                    <h1>{{ $config->modelNames->humanPlural }}</h1>
@endif
                </div>
                <div class="col-sm-6">
                    <a href="#popUp"
                        class="btn btn-primary float-right"
                        onclick="loadeditform('@{{ route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}.create') }}',
                                            '@{{ trans('crud.add_new') }}')">

                    @if($config->options->localized)
                         @@lang('crud.add_new')
@else
                        Add New
@endif
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @@include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            {!! $table !!}
        </div>
    </div>

    @include('livewire.modal')


@@endsection

@@push(
    'page_scripts'
)
    <script >
        function loadeditform(url, title){
            $('#editModal .modal-body').load(url, function(e) {
                $('#editModal').modal('show');
                $('.modal-title').text(title);
            });
        }
    </script>

@@endpush
