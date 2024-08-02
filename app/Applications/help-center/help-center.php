<?php
// Register admin menu item in tools section
addAction('nt_sidebar_menu_items_tools', function(){
    if (hideAccess([2,3,4,5])) :
?>
    <li class="nav-item<?php echo request()->route('slug') == 'help-center' ? ' active' : null; ?>">
        <a href="<?php echo route('dash.tools.page', 'help-center'); ?>">
            <i class="fas fa-info-circle"></i>
            <p><?php echo __('Help Center'); ?></p>
        </a>
    </li>
<?php
    endif;
}, 1);

if (request()->segment(3) === 'help-center') {
    addFilter('custom_admin_page_title', function($title) {
        return __('Help Center');
    }, 1);
    addAction('custom_admin_page_content', function(){
        require_once __DIR__ . "/pages/page-index.php";
    }, 1);
    addAction('custom_admin_page_header_scripts', function(){
        $highlightCSS = app_path('/Applications/help-center/assets/css/highlight.css');
        $highlightCSS = file_get_contents($highlightCSS);
        echo '<style>' . $highlightCSS . '</style>';
    }, 1);
    addAction('custom_admin_page_footer_scripts', function(){
        $highlightJS = app_path('/Applications/help-center/assets/js/highlight.js');
        $highlightJS = file_get_contents($highlightJS);
        echo '<script>' . $highlightJS . '</script>';
        echo '<script>$(document).ready(function(){$("pre.code").highlight({zebra:true,indent:"tabs",});});</script>';
    }, 1);
}