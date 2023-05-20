<div class='btn-group'>
    @permission('view.mails')
    <a href="#popUp" href="{{ $showUrl }}"
       class='btn btn-default' onclick="loadeditform('{{ $showUrl }}', '  {{__('crud.show') . ' ' . $title }}')">
        <i class="fa fa-eye"></i>  @lang('models/mails.button.view')
    </a>
    @endpermission
</div>
