<?php
// Register admin menu item in tools section
addAction('nt_sidebar_menu_items_tools', function(){
    if (hideAccess([2,3,4,5])) :
?>
    <li class="nav-item<?php echo request()->route('slug') == 'info-center' ? ' active' : null; ?>">
        <a href="<?php echo route('dash.tools.page', 'info-center'); ?>">
            <i class="fas fa-info-circle"></i>
            <p>123</p>
        </a>
    </li>
<?php
    endif;
}, 1);

// Custom admin page - Help Center
addAction('custom_admin_page_view', function(){
    
}, 1);