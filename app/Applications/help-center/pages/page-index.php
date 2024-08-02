<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3"><?php echo __('Help Center'); ?></h3>
        <h6 class="op-7 mb-2"><?php echo __('Quick Neutrino Documentation'); ?></h6>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><?php echo __('Documentation List'); ?></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-5 col-md-3 col-lg-3 col-xl-2">
                        <div class="nav flex-column nav-pills nav-secondary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link no-filter active" id="intro-tab" data-bs-toggle="pill" href="#intro" role="tab" aria-controls="intro" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('Introducing'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="dashboard-tab" data-bs-toggle="pill" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('Dashboard UI'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="action-hooks-tab" data-bs-toggle="pill" href="#action-hooks" role="tab" aria-controls="action-hooks" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('System Action Hooks'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="filter-hooks-tab" data-bs-toggle="pill" href="#filter-hooks" role="tab" aria-controls="filter-hooks" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('System Filter Hooks'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="contactus-tab" data-bs-toggle="pill" href="#contactus" role="tab" aria-controls="contactus" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('Help / Contact Us'); ?></strong>
                            </a>
                            <hr>
                            <h5><?php echo __('Functions'); ?></h6>
                            <a class="nav-link no-filter" id="url-tab" data-bs-toggle="pill" href="#url" role="tab" aria-controls="url" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('url'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getOption-tab" data-bs-toggle="pill" href="#getOption" role="tab" aria-controls="getOption" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getOption'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getUser-tab" data-bs-toggle="pill" href="#getUser" role="tab" aria-controls="getUser" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getUser'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getUserRole-tab" data-bs-toggle="pill" href="#getUserRole" role="tab" aria-controls="getUserRole" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getUserRole'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="restrictAccess-tab" data-bs-toggle="pill" href="#restrictAccess" role="tab" aria-controls="restrictAccess" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('restrictAccess'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="hideAccess-tab" data-bs-toggle="pill" href="#hideAccess" role="tab" aria-controls="hideAccess" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('hideAccess'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getHead-tab" data-bs-toggle="pill" href="#getHead" role="tab" aria-controls="getHead" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getHead'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getFooter-tab" data-bs-toggle="pill" href="#getFooter" role="tab" aria-controls="getFooter" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getFooter'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getThemeAssetsUri-tab" data-bs-toggle="pill" href="#getThemeAssetsUri" role="tab" aria-controls="getThemeAssetsUri" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getThemeAssetsUri'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getPermalink-tab" data-bs-toggle="pill" href="#getPermalink" role="tab" aria-controls="getPermalink" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getPermalink'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getMenu-tab" data-bs-toggle="pill" href="#getMenu" role="tab" aria-controls="getMenu" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getMenu'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getMetaData-tab" data-bs-toggle="pill" href="#getMetaData" role="tab" aria-controls="getMetaData" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getMetaData'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getBodyClass-tab" data-bs-toggle="pill" href="#getBodyClass" role="tab" aria-controls="getBodyClass" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getBodyClass'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getCategory-tab" data-bs-toggle="pill" href="#getCategory" role="tab" aria-controls="getCategory" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getCategory'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getTag-tab" data-bs-toggle="pill" href="#getTag" role="tab" aria-controls="getTag" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getTag'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getPage-tab" data-bs-toggle="pill" href="#getPage" role="tab" aria-controls="getPage" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getPage'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getPageByID-tab" data-bs-toggle="pill" href="#getPageByID" role="tab" aria-controls="getPageByID" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getPageByID'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getPost-tab" data-bs-toggle="pill" href="#getPost" role="tab" aria-controls="getPost" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getPost'); ?></strong>
                            </a>
                            <a class="nav-link no-filter" id="getPosts-tab" data-bs-toggle="pill" href="#getPosts" role="tab" aria-controls="getPosts" aria-selected="false" tabindex="-1">
                                <strong><?php echo __('getPosts'); ?></strong>
                            </a>
                        </div>
                    </div>
                    <div class="col-7 col-md-9 col-lg-9 col-xl-10">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade active show" id="intro" role="tabpanel" aria-labelledby="intro-tab">
                                <?php include __DIR__ . "/../tabs/intro.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <?php include __DIR__ . "/../tabs/dash-ui.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="action-hooks" role="tabpanel" aria-labelledby="action-hooks-tab">
                                <?php include __DIR__ . "/../tabs/action-hooks.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="filter-hooks" role="tabpanel" aria-labelledby="filter-hooks-tab">
                                <?php include __DIR__ . "/../tabs/filter-hooks.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="contactus" role="tabpanel" aria-labelledby="contactus-tab">
                                <?php include __DIR__ . "/../tabs/contactus.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="url" role="tabpanel" aria-labelledby="url-tab">
                                <?php include __DIR__ . "/../tabs/url.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getOption" role="tabpanel" aria-labelledby="getOption-tab">
                                <?php include __DIR__ . "/../tabs/get-option.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getUser" role="tabpanel" aria-labelledby="getUser-tab">
                                <?php include __DIR__ . "/../tabs/get-user.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getUserRole" role="tabpanel" aria-labelledby="getUserRole-tab">
                                <?php include __DIR__ . "/../tabs/get-user-role.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="restrictAccess" role="tabpanel" aria-labelledby="restrictAccess-tab">
                                <?php include __DIR__ . "/../tabs/restrict-access.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="hideAccess" role="tabpanel" aria-labelledby="hideAccess-tab">
                                <?php include __DIR__ . "/../tabs/hide-access.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getHead" role="tabpanel" aria-labelledby="getHead-tab">
                                <?php include __DIR__ . "/../tabs/get-head.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getFooter" role="tabpanel" aria-labelledby="getFooter-tab">
                                <?php include __DIR__ . "/../tabs/get-footer.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getThemeAssetsUri" role="tabpanel" aria-labelledby="getThemeAssetsUri-tab">
                                <?php include __DIR__ . "/../tabs/get-theme-assets-url.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getPermalink" role="tabpanel" aria-labelledby="getPermalink-tab">
                                <?php include __DIR__ . "/../tabs/get-permalink.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getMenu" role="tabpanel" aria-labelledby="getMenu-tab">
                                <?php include __DIR__ . "/../tabs/get-menu.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getMetaData" role="tabpanel" aria-labelledby="getMetaData-tab">
                                <?php include __DIR__ . "/../tabs/get-meta-data.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getBodyClass" role="tabpanel" aria-labelledby="getBodyClass-tab">
                                <?php include __DIR__ . "/../tabs/get-body-class.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getCategory" role="tabpanel" aria-labelledby="getCategory-tab">
                                <?php include __DIR__ . "/../tabs/get-category.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getTag" role="tabpanel" aria-labelledby="getTag-tab">
                                <?php include __DIR__ . "/../tabs/get-tag.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getPage" role="tabpanel" aria-labelledby="getPage-tab">
                                <?php include __DIR__ . "/../tabs/get-page.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getPageByID" role="tabpanel" aria-labelledby="getPageByID-tab">
                                <?php include __DIR__ . "/../tabs/get-page-by-id.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getPost" role="tabpanel" aria-labelledby="getPost-tab">
                                <?php include __DIR__ . "/../tabs/get-post.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="getPosts" role="tabpanel" aria-labelledby="getPosts-tab">
                                <?php include __DIR__ . "/../tabs/get-posts.php"; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>