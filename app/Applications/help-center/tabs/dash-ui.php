<?php
    $appPath = app_path('/Applications/help-center');
    $img1 = file_get_contents($appPath . '/assets/images/screen-1.jpg');
    $img2 = file_get_contents($appPath . '/assets/images/screen-2.jpg');
    $img3 = file_get_contents($appPath . '/assets/images/screen-3.jpg');
    $img4 = file_get_contents($appPath . '/assets/images/screen-4.jpg');
?>
<h3><?php echo __('Dashboard UI'); ?></h3>
<p>
    <ul>
        <li>- <a href="#dash">Dashboard</a></li>
        <li>- <a href="#blogs">Blog</a></li>
        <li>- <a href="#pages">Pages</a></li>
        <li>- <a href="#comments">Comments</a></li>
        <li>- <a href="#menu">Menu</a></li>
        <li>- <a href="#media">Media Files</a></li>
        <li>- <a href="#users">Users</a></li>
        <li>- <a href="#appearance">Appearance</a></li>
        <li>- <a href="#apps">Apps</a></li>
        <li>- <a href="#site-settings">Site Settings</a></li>
    </ul>
</p>
<div id="dash">
    <h4 style="padding-top:40px;"><?php echo __('Dashboard'); ?></h4>
    <p><?php echo __('This is the main page of the system\'s admin panel. It can only be accessed after logging in. There is role distribution, meaning only the Administrator has access to all sections.'); ?></p>
    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($img1); ?>" alt="Screen 1" class="screen">
</div>
<div id="blogs">
    <h4 style="padding-top:40px;"><?php echo __('Blog'); ?></h4>
    <p><?php echo __('On the blog page, you will find a list of posts, categories, and tags. This is the section responsible for creating posts.'); ?></p>
    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($img2); ?>" alt="Screen 2" class="screen">
</div>
<div id="pages">
    <h4 style="padding-top:40px;"><?php echo __('Pages'); ?></h4>
    <p><?php echo __('On the "Pages" section, you will find the site\'s pages. These are not posts; they are different. Pages are meant for creating descriptive content. Unlike posts, pages do not have categories or tags. However, in this section, you can set the Blog page and the Home page of the site.'); ?></p>
    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($img3); ?>" alt="Screen 3" class="screen">
</div>
<div id="comments">
    <h4 style="padding-top:40px;"><?php echo __('Comments'); ?></h4>
    <p><?php echo __(''); ?></p>
    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($img4); ?>" alt="Screen 4" class="screen">
</div>