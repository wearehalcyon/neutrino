<div id="admin-bar-padding" class="admin-bar-padding"></div>
<div id="admin-bar" class="admin-bar">
    <ul class="admin-bar-nav left-nav">
        <li>
            <a href="{{ route('dash') }}"><img src="{{ asset('/assets/images/favicon.png') }}" alt="ID Admin" width="20" height="20"></a>
        </li>
        <li>
            <a href="javascript:;">
                <i class="fas fa-paint-brush"></i>
                <span>{{ __('Appearance') }}</span>
            </a>
            <ul class="admin-bar-sub-menu">
                <li><a href="{{ route('dash.themes') }}">{{ __('Themes') }}</a></li>
                <li><a href="{{ route('dash.customize') }}">{{ __('Customize') }}</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <i class="fas fa-file-alt"></i>
                <span>{{ __('Blog') }}</span>
            </a>
            <ul class="admin-bar-sub-menu">
                <li><a href="{{ route('dash.posts') }}">{{ __('All Posts') }}</a></li>
                <li><a href="{{ route('dash.posts.add') }}">{{ __('Add New Post') }}</a></li>
                <li><a href="{{ route('dash.categories') }}">{{ __('Categories') }}</a></li>
                <li><a href="{{ route('dash.tags') }}">{{ __('Tags') }}</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <i class="fas fa-file"></i>
                <span>{{ __('Pages') }}</span>
            </a>
            <ul class="admin-bar-sub-menu">
                <li><a href="{{ route('dash.pages') }}">{{ __('All Pages') }}</a></li>
                <li><a href="{{ route('dash.pages.add') }}">{{ __('Add New Page') }}</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <i class="fas fa-bars"></i>
                <span>{{ __('Menus') }}</span>
            </a>
            <ul class="admin-bar-sub-menu">
                <li><a href="{{ route('dash.menus') }}">{{ __('All Menus') }}</a></li>
                <li><a href="{{ route('dash.menus.add') }}">{{ __('Add New Menu') }}</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <i class="fas fa-comment-alt"></i>
                <span>{{ __('Comments') }}</span>
            </a>
            <ul class="admin-bar-sub-menu">
                <li><a href="{{ route('dash.comments') }}">{{ __('All Comments') }}</a></li>
            </ul>
        </li>
        <span class="ab-dm-none" style="margin-left: 5px;">|</span>
        <li class="ab-dm-none">
            <a href="{{ route('dash.posts.add') }}"><i class="fas fa-plus" style="margin-right: 5px;"></i><span>{{ __('Add New Post') }}</span></a>
        </li>
        <li class="ab-dm-none">
            <a href="{{ route('dash.pages.add') }}"><i class="fas fa-plus" style="margin-right: 5px;"></i><span>{{ __('Add New Page') }}</span></a>
        </li>
        <span class="ab-dm-none" style="margin-left: 5px;">|</span>
    </ul>
    <ul class="admin-bar-nav right-nav">
        <li>
            <a href="javascript:;">
                <i class="fas fa-user-friends"></i>
                <span>{{ __('Howdy, ') . Auth::user()->name . '!' }}</span>
            </a>
            <ul class="admin-bar-sub-menu">
                <li><a href="{{ route('dash.users.edit', Auth::id()) }}">{{ __('Settings') }}</a></li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">{{ __('Logout') }}</button>
                </form>
            </ul>
        </li>
    </ul>
</div>
