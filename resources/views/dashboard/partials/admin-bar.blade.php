<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["{{ asset('assets/css/fonts.min.css') }}"],
        },
        active: function () {
            sessionStorage.fonts = true;
        },
    });
</script>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    #admin-bar-padding.admin-bar-padding{
        position: sticky;
        width: 100%;
        height: 32px;
        top: 0;
        left: 0;
        z-index: 999999999999999989;
    }
    #admin-bar.admin-bar{
        font-family: sans-serif;
        font-size: 14px;
        background: #1a2035;
        color: #b9babf;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: auto;
        z-index: 999999999999999999;
    }
    #admin-bar.admin-bar .admin-bar-nav{
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        list-style-type: none;
        margin: 0 10px;
        padding: 0;
    }
    #admin-bar.admin-bar .admin-bar-nav li{
        display: inline-block;
        position: relative;
    }
    #admin-bar.admin-bar .admin-bar-nav li a{
        display: inline-block;
        color: #b9babf;
        padding: 5px;
        text-decoration: none;
        font-size: 13px;
        border-radius: 4px;
        margin-left: 5px;
    }
    #admin-bar.admin-bar .admin-bar-nav li:first-child a{
        border-radius: 0px;
        margin: 0;
    }
    #admin-bar.admin-bar .admin-bar-nav li:hover a{
        background: rgba(255,255,255,.2);
        color: #fff;
    }
    #admin-bar.admin-bar .admin-bar-nav li .admin-bar-sub-menu{
        display: none;
        position: absolute;
        width: 200px;
        height: auto;
        padding: 8px 5px;
        background-color: rgba(0,0,0,.2);
        box-shadow: 0 5px 20px rgba(0,0,0,.2);
        border-radius: 6px;
        backdrop-filter: blur(30px) saturate(1.2);
        border: 1px solid rgba(255,255,255,.15);
    }
    #admin-bar.admin-bar .admin-bar-nav li:hover .admin-bar-sub-menu{
        display: block;
    }
    #admin-bar.admin-bar .admin-bar-nav li .admin-bar-sub-menu li{
        display: block;
    }
    #admin-bar.admin-bar .admin-bar-nav li .admin-bar-sub-menu li a{
        display: block;
        font-weight: 300;
        background: transparent;
        padding: 5px 10px;
        color: #fff;
        border-radius: 4px;
        margin: 0;
        text-shadow: 0 0 15px #000, 0 0 5px rgba(0,0,0,.5);
    }
    #admin-bar.admin-bar .admin-bar-nav li .admin-bar-sub-menu li:hover a{
        background: rgba(255,255,255,.2);
        color: #fff;
        filter: brightness(1);
    }
    #admin-bar.admin-bar .admin-bar-nav.right-nav li .admin-bar-sub-menu{
        left: auto;
        right: 0;
    }
    #admin-bar.admin-bar .admin-bar-nav.right-nav li .admin-bar-sub-menu form button{
        display: block;
        border: none;
        cursor: pointer;
        width: 100%;
        font-weight: 300;
        background: transparent;
        padding: 5px 10px;
        color: #fff;
        border-radius: 4px;
        margin: 0;
        text-align: left;
        text-shadow: 0 0 15px #000, 0 0 5px rgba(0,0,0,.5);
    }
    #admin-bar.admin-bar .admin-bar-nav.right-nav li .admin-bar-sub-menu form button:hover{
        background: rgba(255,255,255,.2);
        color: #fff;
        filter: brightness(1);
    }
</style>
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
        <span style="margin-left: 5px;">|</span>
        <li>
            <a href="{{ route('dash.posts.add') }}"><i class="fas fa-plus" style="margin-right: 5px;"></i><span>{{ __('Add New Post') }}</span></a>
        </li>
        <li>
            <a href="{{ route('dash.pages.add') }}"><i class="fas fa-plus" style="margin-right: 5px;"></i><span>{{ __('Add New Page') }}</span></a>
        </li>
        <span style="margin-left: 5px;">|</span>
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
