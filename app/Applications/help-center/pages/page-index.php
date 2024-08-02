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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>