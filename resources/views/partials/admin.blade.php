
<li class="nav-item menu-is-opening menu-open">
    <a href="#" class="nav-link {{ Request::is('administration*') ? 'active' : '' }} ">
        <i class="nav-icon fas fa-home"></i>
        <p>@lang('nav.settings')
            <i class="fas fa-angle-left @if(app()->getLocale()=='en') right @else left @endif""></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: block;">

        <li class="nav-item">
            <a href="{{ route('services.index') }}" class="nav-link {{ Request::is('administration/services*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-building"></i>
                <p>@lang('models/services.plural')</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('registers.index') }}" class="nav-link {{ Request::is('administration/registers*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-hand-paper"></i>
                <p>@lang('models/registers.plural')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('actions.index') }}" class="nav-link {{ Request::is('administration/actions*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-project-diagram"></i>
                <p>@lang('models/actions.plural')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('administration/users*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>@lang('models/users.plural')</p>
            </a>
        </li>
        <!-- need to remove -->
        <li class="nav-item">
            <a href="{{ route('laravelroles::roles.index') }}"
               class="nav-link {{ Request::is('administration/roles') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>{{__('nav.roles')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('etablissements.index') }}" class="nav-link {{ Request::is('etablissements*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>@lang('models/etablissements.plural')</p>
            </a>
        </li>

       {{--  <li class="nav-item">
            <a href="{{ route('parafeures.index') }}" class="nav-link {{ Request::is('parafeures*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>@lang('models/parafeures.plural')</p>
            </a>
        </li> --}}

    </ul>
</li>

