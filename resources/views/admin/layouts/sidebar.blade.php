<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" width="45px" src="https://gnd.center/bpm/resources/img/avatar-overlay-blank.png" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">John Doe</p>
            <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">{{ __('Dashboard') }}</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.publishers.index' ? 'active' : '' }}" href="{{ route('admin.publishers.index') }}">
                <i class="app-menu__icon fa fa-bookmark-o"></i>
                <span class="app-menu__label">Publishers</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                <i class="app-menu__icon fa fa-tags"></i>
                <span class="app-menu__label">Categories</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}" href="{{ route('admin.settings') }}"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">{{ __('Settings') }}</span>
            </a>
        </li>
    </ul>
</aside>
