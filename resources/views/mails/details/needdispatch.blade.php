@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/mails.plural')</h1>
                </div>
                <div class="col-sm-6">
                    @permission('create.mails')
                    <a href="#popUp"
                        class="btn btn-primary float-right"
                        onclick="loadeditform('{{ route('mails.create') }}',
                                            '{{ trans('crud.add_new') }}')">

                                             @lang('crud.add_new')
                    </a>
                    @endpermission
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                @livewire('details.needdispatch-mails-table', [])
            </div>
        </div>
    </div>

    <div class="modal fade " id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>


@endsection

@push(
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

@endpush
