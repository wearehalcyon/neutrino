<?php
// Register admin menu item in tools section
addAction('nt_sidebar_menu_items_tools', function(){
    if (hideAccess([2,3,4,5])) :
?>
    <li class="nav-item<?php echo request()->route('slug') == 'seo-support' ? ' active' : null; ?>">
        <a href="<?php echo route('dash.tools.page', 'seo-support'); ?>">
            <i class="fab fa-searchengin"></i>
            <p><?php echo __('SEO Support'); ?></p>
        </a>
    </li>
<?php
    endif;
}, 1);

// Add page action
if (request()->segment(3) === 'seo-support') {
    addFilter('custom_admin_page_title', function($title) {
        return __('SEO Support');
    }, 1);
    addAction('custom_admin_page_content', function(){
        require_once __DIR__ . "/pages/page-index.php";
    }, 1);
}