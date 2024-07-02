<style>
    #admin-bar-padding.admin-bar-padding{
        position: relative;
        padding-bottom: 32px;
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
        margin-bottom: 100px;
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
        padding: 6px 5px;
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
</style>
<div id="admin-bar-padding" class="admin-bar-padding"></div>
<div id="admin-bar" class="admin-bar">
    <ul class="admin-bar-nav left-nav">
        <li>
            <a href="/id-admin"><img src="/assets/images/favicon.png" alt="ID Admin" width="20" height="20"></a>
        </li>
        <li>
            <a href="javascript:;">
                <span>Appearance</span>
            </a>
            <ul class="admin-bar-sub-menu">
                <li><a href="/id-admin/themes">Themes</a></li>
                <li><a href="/id-admin/site-identity">Site Identity</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <span>Blog</span>
            </a>
            <ul class="admin-bar-sub-menu">
                <li><a href="/id-admin/posts">All Posts</a></li>
                <li><a href="/id-admin/posts/add">Add New Post</a></li>
                <li><a href="/id-admin/categories">Categories</a></li>
                <li><a href="/id-admin/tags">Tags</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <span>Pages</span>
            </a>
            <ul class="admin-bar-sub-menu">
                <li><a href="/id-admin/pages">All Pages</a></li>
                <li><a href="/id-admin/pages/add">Add New Page</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <span>Menus</span>
            </a>
            <ul class="admin-bar-sub-menu">
                <li><a href="/id-admin/menus">All Menus</a></li>
                <li><a href="/id-admin/menus/add">Add New Menu</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <span>Comments</span>
            </a>
            <ul class="admin-bar-sub-menu">
                <li><a href="/id-admin/comments">All Comments</a></li>
            </ul>
        </li>
        <span style="margin-left: 5px;">|</span>
        <li>
            <a href="/id-admin/posts/add"><span>Add New Post</span></a>
        </li>
        <li>
            <a href="/id-admin/pages/add"><span>Add New Page</span></a>
        </li>
    </ul>
    <ul class="admin-bar-nav right-nav">
        <li>
            <a href="javascript:;">
                <span>My Account</span>
            </a>
        </li>
    </ul>
</div>
