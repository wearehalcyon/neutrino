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
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#menu" class="" aria-expanded="false">
                        <i class="fas fa-bars"></i>
                        <p>{{ __('Menu') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="menu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">{{ __('All Menus') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/avatars.html">
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
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                      <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">{{ __('User Settings') }}</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#users" class="" aria-expanded="false">
                        <i class="fas fa-user-friends"></i>
                        <p>{{ __('Users') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">{{ __('All Users') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">{{ __('Account Settings') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item @if($routeName == 'media'){{ 'active' }}@endif">
                    <a href="{{ route('dash') }}">
                        <i class="fas fa-ban"></i>
                        <p>{{ __('User Roles') }}</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                      <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">{{ __('Tools') }}</h4>
                </li>
                <li class="nav-item @if($routeName == 'dash.site-settings'){{ 'active' }}@endif">
                    <a href="{{ route('dash.site-settings') }}">
                        <i class="fas fa-cog"></i>
                        <p>{{ __('Site Settings') }}</p>
                    </a>
                </li>
                <li class="nav-item @if($routeName == 'media'){{ 'active' }}@endif">
                    <a href="{{ route('dash') }}">
                        <i class="fas fa-info-circle"></i>
                        <p>{{ __('Help') }}</p>
                    </a>
                </li>
                <li class="nav-item @if($routeName == 'media'){{ 'active' }}@endif">
                    <a href="{{ route('dash') }}">
                        <i class="fas fa-puzzle-piece"></i>
                        <p>{{ __('ZEN Tools') }}</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
