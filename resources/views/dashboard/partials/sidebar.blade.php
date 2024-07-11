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
                    <li class="nav-item @if(in_array($routeName, ['dash.categories', 'dash.categories.add', 'dash.categories.edit', 'dash.tags', 'dash.tags.add', 'dash.tags.edit', 'dash.posts', 'dash.posts.add', 'dash.posts.edit'])){{ __('submenu active') }}@endif">
                        <a data-bs-toggle="collapse" href="#blog" class="@if(in_array($routeName, ['dash.categories', 'dash.categories.add', 'dash.categories.edit', 'dash.tags', 'dash.tags.add', 'dash.tags.edit', 'dash.posts', 'dash.posts.add', 'dash.posts.edit'])){{ __('active') }}@endif" aria-expanded="false">
                            <i class="fas fa-file-alt"></i>
                            <p>{{ __('Blog') }}</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse @if(in_array($routeName, ['dash.categories', 'dash.categories.add', 'dash.categories.edit', 'dash.tags', 'dash.tags.add', 'dash.tags.edit', 'dash.posts', 'dash.posts.add', 'dash.posts.edit'])){{ __('show') }}@endif" id="blog">
                            <ul class="nav nav-collapse">
                                <li class="@if(in_array($routeName, ['dash.posts', 'dash.posts.add', 'dash.posts.edit'])){{ __('active') }}@endif">
                                    <a href="{{ route('dash.posts') }}">
                                        <span class="sub-item">{{ __('All Posts') }}</span>
                                    </a>
                                </li>
                                <li class="@if(in_array($routeName, ['dash.categories', 'dash.categories.add', 'dash.categories.edit'])){{ __('active') }}@endif">
                                    <a href="{{ route('dash.categories') }}">
                                        <span class="sub-item">{{ __('Categories') }}</span>
                                    </a>
                                </li>
                                <li class="@if(in_array($routeName, ['dash.tags', 'dash.tags.add', 'dash.tags.edit'])){{ __('active') }}@endif">
                                    <a href="{{ route('dash.tags') }}">
                                        <span class="sub-item">{{ __('Tags') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item @if(in_array($routeName, ['dash.pages', 'dash.pages.add', 'dash.pages.edit'])){{ __('active') }}@endif">
                        <a href="{{ route('dash.pages') }}">
                            <i class="fas fa-file"></i>
                            <p>{{ __('Pages') }}</p>
                        </a>
                    </li>
                    <li class="nav-item @if(in_array($routeName, ['dash.comments'])){{ __('active') }}@endif">
                        <a href="{{ route('dash.comments') }}">
                            <i class="fas fa-comment-alt"></i>
                            <p>{{ __('Comments') }}</p>
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
                    <li class="nav-item @if(in_array($routeName, ['dash.c-forms', 'dash.c-forms.add', 'dash.c-forms.edit', 'dash.c-forms-db', 'dash.c-forms-db.view'])){{ __('submenu active') }}@endif">
                        <a data-bs-toggle="collapse" href="#c-forms" class="@if(in_array($routeName, ['dash.c-forms', 'dash.c-forms.add', 'dash.c-forms.edit', 'dash.c-forms-db', 'dash.c-forms-db.view'])){{ __('active') }}@endif" aria-expanded="false">
                            <i class="fas fa-envelope"></i>
                            <p>{{ __('Contact Forms') }}</p>
                            @if(getContactFormsMessages()->count() > 0)
                                <span class="badge badge-danger">{{ getContactFormsMessages()->count() }}</span>
                            @endif
                            <span class="caret"></span>
                        </a>
                        <div class="collapse @if(in_array($routeName, ['dash.c-forms', 'dash.c-forms.add', 'dash.c-forms.edit', 'dash.c-forms-db', 'dash.c-forms-db.view'])){{ __('show') }}@endif" id="c-forms">
                            <ul class="nav nav-collapse">
                                <li class="@if(in_array($routeName, ['dash.c-forms', 'dash.c-forms.add', 'dash.c-forms.edit'])){{ __('active') }}@endif">
                                    <a href="{{ route('dash.c-forms') }}">
                                        <span class="sub-item">{{ __('All Forms') }}</span>
                                    </a>
                                </li>
                                <li class="@if(in_array($routeName, ['dash.c-forms-db', 'dash.c-forms-db.view'])){{ __('active') }}@endif">
                                    <a href="{{ route('dash.c-forms-db') }}">
                                        <span class="sub-item">
                                            {{ __('Forms Database') }}
                                            @if(getContactFormsMessages()->count() > 0)
                                                <span class="badge badge-danger">{{ getContactFormsMessages()->count() }}</span>
                                            @endif
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item @if(in_array($routeName, ['dash.fm'])){{ 'active' }}@endif">
                        <a href="{{ route('dash.fm') }}">
                            <i class="fas fa-hdd"></i>
                            <p>{{ __('Media Files') }}</p>
                        </a>
                    </li>
                    <li class="nav-item @if(in_array($routeName, ['dash.users', 'dash.users.edit', 'dash.users.edit-account', 'dash.users.add'])){{ 'active' }}@endif">
                        <a href="{{ route('dash.users') }}">
                            <i class="fas fa-user-friends"></i>
                            <p>{{ __('Users') }}</p>
                        </a>
                    </li>
                @endif
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                      <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">{{ __('Tools') }}</h4>
                </li>
                @if(hideAccess([3,4,5]))
                    <li class="nav-item @if(in_array($routeName, ['dash.themes', 'dash.customize'])){{ __('submenu active') }}@endif">
                        <a data-bs-toggle="collapse" href="#appearance" class="@if(in_array($routeName, ['dash.themes', 'dash.customize'])){{ __('active') }}@endif" aria-expanded="false">
                            <i class="fas fa-paint-brush"></i>
                            <p>{{ __('Appearance') }}</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse @if(in_array($routeName, ['dash.themes', 'dash.customize'])){{ __('show') }}@endif" id="appearance">
                            <ul class="nav nav-collapse">
                                <li class="@if(in_array($routeName, ['dash.themes'])){{ __('active') }}@endif">
                                    <a href="{{ route('dash.themes') }}">
                                        <span class="sub-item">{{ __('Themes') }}</span>
                                    </a>
                                </li>
                                <li class="@if(in_array($routeName, ['dash.customize'])){{ __('active') }}@endif">
                                    <a href="{{ route('dash.customize') }}">
                                        <span class="sub-item">{{ __('Customize') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item @if($routeName == 'dash.site-settings'){{ 'active' }}@endif">
                        <a href="{{ route('dash.site-settings') }}">
                            <i class="fas fa-cog"></i>
                            <p>{{ __('Site Settings') }}</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item @if($routeName == 'help'){{ 'active' }}@endif">
                    <a href="{{ route('dash') }}">
                        <i class="fas fa-info-circle"></i>
                        <p>{{ __('Help') }}</p>
                    </a>
                </li>
                @if(hideAccess([2,3,4,5]))
                    <li class="nav-item @if($routeName == 'zen'){{ 'active' }}@endif">
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
