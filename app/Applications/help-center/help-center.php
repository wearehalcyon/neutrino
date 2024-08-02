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
        require_once app_path('/Applications/help-center/pages/page-index.php');
    }, 1);
    addAction('custom_admin_page_header_scripts', function(){
        $highlightCSS = app_path('/Applications/help-center/assets/css/highlight.css');
        $highlightCSS = file_get_contents($highlightCSS);
        echo '<style>' . $highlightCSS . '</style>';
        echo '<style>
            ul{
                list-style-type: none;
                margin-bottom: 20px;
            }
            ul li{
                display: block;
                font-size: 16px;
            }
            ul li code{
                font-size: 17px;
            }
            .screen{
                max-width: 100%;
                height: auto;
                width: 250px;
                cursor: pointer;
            }
            .swal2-popup.swal2-modal{
                min-width: 1600px;
                max-width: 100%;
                height: auto;
            }
        </style>';
    }, 1);
    addAction('custom_admin_page_footer_scripts', function(){
        $highlightJS = app_path('/Applications/help-center/assets/js/highlight.js');
        $highlightJS = file_get_contents($highlightJS);
        echo '<script>' . $highlightJS . '</script>';
        echo '<script>$(document).ready(function(){$("pre.code").highlight({zebra:true,indent:"tabs",});});</script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
            $(".screen").on("click", function(){
                let image = $(this).attr("src");
                Swal.fire({
                    html: `<img src="${image}" alt="Image" style="max-width: 100%; height: auto;">`,
                    confirmButtonText: "Close"
                });
            });
        </script>';
    }, 1);
}