<?php
    $appPath = app_path('/Applications/help-center');
    $img1 = file_get_contents($appPath . '/assets/images/screen-1.jpg');
    $img2 = file_get_contents($appPath . '/assets/images/screen-2.jpg');
    $img3 = file_get_contents($appPath . '/assets/images/screen-3.jpg');
    $img4 = file_get_contents($appPath . '/assets/images/screen-4.jpg');
    $img5 = file_get_contents($appPath . '/assets/images/screen-5.jpg');
    $img6 = file_get_contents($appPath . '/assets/images/screen-6.jpg');
    $img7 = file_get_contents($appPath . '/assets/images/screen-7.jpg');
    $img8 = file_get_contents($appPath . '/assets/images/screen-8.jpg');
    $img9 = file_get_contents($appPath . '/assets/images/screen-9.jpg');
    $img10 = file_get_contents($appPath . '/assets/images/screen-10.jpg');
    $img11 = file_get_contents($appPath . '/assets/images/screen-11.jpg');
?>
<h3><?php echo __('Dashboard UI'); ?></h3>
<p>
    <ul>
        <li>- <a href="#dash">Dashboard</a></li>
        <li>- <a href="#blogs">Blog</a></li>
        <li>- <a href="#pages">Pages</a></li>
        <li>- <a href="#comments">Comments</a></li>
        <li>- <a href="#menus">Menu</a></li>
        <li>- <a href="#media">Media Files</a></li>
        <li>- <a href="#users">Users</a></li>
        <li>- <a href="#appearances">Appearance</a></li>
        <li>- <a href="#appss">Apps</a></li>
        <li>- <a href="#sitesettings">Site Settings</a></li>
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
    <p><?php echo __('On the comments page, you can manage discussions on your site. You have the ability to delete, approve, or reject individual comments.'); ?></p>
    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($img4); ?>" alt="Screen 4" class="screen">
</div>
<div id="menus">
    <h4 style="padding-top:40px;"><?php echo __('Menu'); ?></h4>
    <p><?php echo __('The menu page is responsible for creating menus and their items. You need to create at least one menu before you can add items to it. This step is crucial before you can organize any of your menus.'); ?></p>
    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($img5); ?>" alt="Screen 5" class="screen">
</div>
<div id="media">
    <h4 style="padding-top:40px;"><?php echo __('Media Files'); ?></h4>
    <p><?php echo __('On the media files page, you will find a file manager where you can add, delete, and crop your images. The file manager is not limited to just images, it allows you to easily work with virtually any type of file.'); ?></p>
    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($img6); ?>" alt="Screen 6" class="screen">
</div>
<div id="users">
    <h4 style="padding-top:40px;"><?php echo __('Users'); ?></h4>
    <p><?php echo __('The users page allows you to manage accounts. Here, you can create, delete, or edit any account if you have the appropriate permissions. Otherwise, you only have access to your own account. However, administrators also have access to their own profile.'); ?></p>
    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($img7); ?>" alt="Screen 7" class="screen">
</div>
<div id="appearances">
    <h4 style="padding-top:40px;"><?php echo __('Appearance'); ?></h4>
    <p><?php echo __('On the Appearance page, you can manage your themes. Installing and deleting them is a breeze! Just make sure to follow the theme creation guidelines if you\'re a developer. Additionally, in the customization section, you\'ll find basic site settings such as the logo, banner, favicon, and even scripts for the header and footer of the site.'); ?></p>
    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($img8); ?>" alt="Screen 8" class="screen">
    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($img9); ?>" alt="Screen 9" class="screen">
</div>
<div id="appss">
    <h4 style="padding-top:40px;"><?php echo __('Apps'); ?></h4>
    <p><?php echo __('On the Applications page, you can install any application from the repository, as well as remove or deactivate it. Currently, we haven\'t opened up for third-party application installations, but this may change soon.'); ?></p>
    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($img10); ?>" alt="Screen 10" class="screen">
</div>
<div id="sitesettings">
    <h4 style="padding-top:40px;"><?php echo __('Site Settings'); ?></h4>
    <p><?php echo __('The Site Settings page handles the main site information, such as the Title, Description, Admin Email, enabling or disabling the debug bar, setting the homepage and blog pages, and more.'); ?></p>
    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($img11); ?>" alt="Screen 11" class="screen">
</div>