<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dash') }}" title="{{ __('Dashboard Home') }}">
                <img src="{{ asset('assets/images/svg/id-logo-dash.svg') }}" alt="{{ __('Dashboard Home') }}" width="112" height="30">
            </a>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item @if($routeName == 'dash'){{ 'active' }}@endif">
                    <a href="{{ route('dash') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>
                @if(hideAccess([3,4,5]))
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                          <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">{{ __('Content') }}</h4>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#blog" class="" aria-expanded="false">
                            <i class="fas fa-file-alt"></i>
                            <p>{{ __('Blog') }}</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="blog">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="components/avatars.html">
                                        <span class="sub-item">All Articles</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/avatars.html">
                                        <span class="sub-item">Categories</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/avatars.html">
                                        <span class="sub-item">Tags</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item @if($routeName == 'media'){{ 'active' }}@endif">
                        <a href="{{ route('dash') }}">
                            <i class="fas fa-file"></i>
                            <p>{{ __('Pages') }}</p>
                        </a>
                    </li>
                    <li class="nav-item @if(in_array($routeName, ['dash.menus', 'dash.menus.add', 'dash.menus.edit', 'dash.menu.items', 'dash.menu.items.add', 'dash.menu.items.edit'])){{ __('submenu active') }}@endif">
                        <a data-bs-toggle="collapse" href="#menu" class="@if(in_array($routeName, ['dash.menus', 'dash.menus.add', 'dash.menus.edit', 'dash.menu.items.add', 'dash.menu.items.edit'])){{ __('active') }}@endif" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                            <p>{{ __('Menu') }}</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse @if(in_array($routeName, ['dash.menus', 'dash.menus.add', 'dash.menus.edit', 'dash.menu.items', 'dash.menu.items.add', 'dash.menu.items.edit'])){{ __('show') }}@endif" id="menu">
                            <ul class="nav nav-collapse">
                                <li class="@if(in_array($routeName, ['dash.menus', 'dash.menus.add', 'dash.menus.edit'])){{ __('active') }}@endif">
                                    <a href="{{ route('dash.menus') }}">
                                        <span class="sub-item">{{ __('All Menus') }}</span>
                                    </a>
                                </li>
                                <li class="@if(in_array($routeName, ['dash.menu.items', 'dash.menu.items.add', 'dash.menu.items.edit'])){{ __('active') }}@endif">
                                    <a href="{{ route('dash.menu.items') }}">
                                        <span class="sub-item">{{ __('Menu Items') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item @if($routeName == 'media'){{ 'active' }}@endif">
                        <a href="{{ route('dash') }}">
                            <i class="fas fa-envelope"></i>
                            <p>{{ __('Forms Database') }}</p>
                        </a>
                    </li>
                    <li class="nav-item @if($routeName == 'media'){{ 'active' }}@endif">
                        <a href="{{ route('dash') }}">
                            <i class="fas fa-hdd"></i>
                            <p>{{ __('Media Files') }}</p>
                        </a>
                    </li>
                    <li class="nav-item @if(in_array($routeName, ['dash.users', 'dash.users.edit', 'dash.users.edit-account', 'dash.users.edit-account.add'])){{ 'active' }}@endif">
                        <a href="{{ route('dash.users') }}">
                            <i class="fas fa-user-friends"></i>
                            <p>{{ __('Users') }}</p>
                        </a>
                    </li>
    {{--                <li class="nav-item @if($routeName == 'dash.users-roles'){{ 'active' }}@endif">--}}
    {{--                    <a href="{{ route('dash.users-roles') }}">--}}
    {{--                        <i class="fas fa-ban"></i>--}}
    {{--                        <p>{{ __('User Roles') }}</p>--}}
    {{--                    </a>--}}
    {{--                </li>--}}
                @endif
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                      <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">{{ __('Tools') }}</h4>
                </li>
                @if(hideAccess([3,4,5]))
                    <li class="nav-item @if($routeName == 'dash.site-settings'){{ 'active' }}@endif">
                        <a href="{{ route('dash.site-settings') }}">
                            <i class="fas fa-cog"></i>
                            <p>{{ __('Site Settings') }}</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item @if($routeName == 'media'){{ 'active' }}@endif">
                    <a href="{{ route('dash') }}">
                        <i class="fas fa-info-circle"></i>
                        <p>{{ __('Help') }}</p>
                    </a>
                </li>
                @if(hideAccess([2,3,4,5]))
                    <li class="nav-item @if($routeName == 'media'){{ 'active' }}@endif">
                        <a href="{{ route('dash') }}">
                            <i class="fas fa-puzzle-piece"></i>
                            <p>{{ __('ZEN Tools') }}</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
