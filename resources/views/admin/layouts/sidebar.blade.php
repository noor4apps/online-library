<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" width="45px" src="https://gnd.center/bpm/resources/img/avatar-overlay-blank.png" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ Auth::user()->full_name }}</p>
            <p class="app-sidebar__user-designation"></p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">{{ __('Dashboard') }}</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.customers.index' ? 'active' : '' }}" href="{{ route('admin.customers.index') }}">
                <i class="app-menu__icon fa fa-users"></i>
                <span class="app-menu__label">{{ __('Customers') }}</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.orders.index' ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="app-menu__icon fa fa-inbox"></i>
                <span class="app-menu__label">{{ __('Orders') }}</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.books.index' ? 'active' : '' }}" href="{{ route('admin.books.index') }}">
                <i class="app-menu__icon fa fa-book"></i>
                <span class="app-menu__label">{{ __('Books') }}</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.authors.index' ? 'active' : '' }}" href="{{ route('admin.authors.index') }}">
                <i class="app-menu__icon fa fa-pencil-square-o"></i>
                <span class="app-menu__label">{{ __('Authors') }}</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.publishers.index' ? 'active' : '' }}" href="{{ route('admin.publishers.index') }}">
                <i class="app-menu__icon fa fa-bookmark-o"></i>
                <span class="app-menu__label">{{ __('Publishers') }}</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                <i class="app-menu__icon fa fa-tags"></i>
                <span class="app-menu__label">{{ __('Categories') }}</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.shelves.index' ? 'active' : '' }}" href="{{ route('admin.shelves.index') }}">
                <i class="app-menu__icon fa fa-archive"></i>
                <span class="app-menu__label">{{ __('shelves') }}</span>
            </a>
        </li>

    </ul>
</aside>
