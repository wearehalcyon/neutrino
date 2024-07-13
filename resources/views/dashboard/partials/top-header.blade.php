<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle no-filter no-bg" href="#" id="messageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-envelope"></i>
                        @if(getContactFormsMessages()->count() > 0)
                            <span class="notification">{{ getContactFormsMessages()->count() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                        <li>
                            <div class="dropdown-title d-flex justify-content-between align-items-center">
                                {{ __('Contact Form Messages') }}
{{--                                <a href="#" class="small">Mark all as read</a>--}}
                            </div>
                        </li>
                        <li>
                            <div class="scroll-wrapper message-notif-scroll scrollbar-outer" style="position: relative;"><div class="message-notif-scroll scrollbar-outer scroll-content" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 0px;">
                                    <div class="notif-center">
                                        @foreach(getContactFormsMessages() as $message)
                                            <a href="{{ route('dash.c-forms-db.view', [$message->id, $message->form_unique_id]) }}" class="no-filter">
                                                <div class="notif-content">
                                                    <span class="subject">{{ $message->form_name }}</span>
                                                    <span class="time">{{ date('M d, Y', strtotime($message->created_at)) . ' at ' . date('H:i:s', strtotime($message->created_at)) }}</span>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div><div class="scroll-element scroll-x"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar"></div></div></div><div class="scroll-element scroll-y"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar"></div></div></div></div>
                        </li>
                        <li>
                            <a class="see-all" href="{{ route('dash.c-forms-db') }}">See all messages<i class="fa fa-angle-right"></i> </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item open-homepage">
                    <a href="{{ route('pages.home') }}" class="nav-link no-filter" title="{{ __('Open Site') }}" target="_blank">
                        <i class="fas fa-globe"></i> {{ __('Open Site') }}
                    </a>
                </li>
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic no-filter no-bg" data-bs-toggle="dropdown" href="#" aria-expanded="false" >
                        <div class="avatar-sm">
                            <img src="{{ asset('assets/images/svg/user.svg') }}" alt="..." class="avatar-img rounded-circle" />
                        </div>
                        <span class="profile-username">
                                    <span class="op-7">Hi,</span>
                                    <span class="fw-bold">{{ getUser(Auth::id())->name }}</span>
                                </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="u-text px-0">
                                        <h4>{{ getUser(Auth::id())->name }}</h4>
                                        <p class="text-muted">{{ getUser(Auth::id())->email }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('dash.users.edit', Auth::id()) }}">{{ __('Account Setting') }}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
