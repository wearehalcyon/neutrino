<h3><?php echo __('getHead'); ?></h3>
<p><?php echo __('Function returns base template styles and scripts. Important to initialization admin bar. Should be placed inside of <code>' . htmlspecialchars("<head>") . '</code> and <code>' . htmlspecialchars("</head>") . '</code> tags.'); ?></p>
<hr>
<p><?php echo __('<code>getHead</code> Function source code:'); ?></p>
<pre class="code">
    function getHead(){
        $array = [];
        $settings = Setting::where([
            'option_name' => 'favicon',
        ])->get();

        if ($settings->isNotEmpty()) {
            foreach ($settings as $setting) {
                $array['favicon'] = $setting->option_value;
            }
        } else {
            $array['favicon'] = null;
        }

        echo '<script id="nt-base-webfont-script" src="' . asset('assets/js/plugin/webfont/webfont.min.js') . '"></script>';
        if ($array['favicon']) {
            echo '<link id="nt-base-favicon" rel="icon" href="' . asset('uploads/' . $array['favicon']) . '" type="image/x-icon">';
            echo '<link rel="apple-touch-icon" href="' . asset('uploads/' . $array['favicon']) . '">';
        } else {
            echo '<link id="nt-base-favicon" rel="icon" href="' . asset('favicon.png') . '" type="image/x-icon">';
            echo '<link rel="apple-touch-icon" href="' . asset('favicon.png') . '">';
        }
        $linkFonts = asset('assets/css/fonts.min.css');
        echo <<<HTML
            <script id="nt-base-webfont-inline-script">
                WebFont.load({
                    google: { families: ["Public Sans:300,400,500,600,700"] },
                    custom: {
                        families: [
                            "Font Awesome 5 Solid",
                            "Font Awesome 5 Regular",
                            "Font Awesome 5 Brands",
                            "simple-line-icons",
                        ],
                        urls: ["$linkFonts"],
                    },
                    active: function () {
                        sessionStorage.fonts = true;
                    },
                });
            </script>
            HTML;
        echo <<<HTML
                <style id="nt-base-admin-bar-styles">
                    *{
                        margin: 0;
                        padding: 0;
                    }
                    #admin-bar-padding.admin-bar-padding{
                        position: sticky;
                        width: 100%;
                        height: 30px;
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
                        -webkit-backdrop-filter: blur(30px) saturate(1.2);
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
                    @media screen and (max-width: 1200px) {
                        #admin-bar.admin-bar .admin-bar-nav .ab-dm-none,
                        #admin-bar.admin-bar .admin-bar-nav li.ab-dm-none{
                            display: none;
                        }
                        #admin-bar.admin-bar .admin-bar-nav li a{
                            font-size: 0;
                        }
                        #admin-bar.admin-bar .admin-bar-nav li a i{
                            font-size: 16px;
                        }
                        #admin-bar.admin-bar .admin-bar-nav li .admin-bar-sub-menu li a{
                            font-size: 15px;
                        }
                    }
                </style>
            HTML;
        echo getOption('head_scripts');
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getHead</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getHead()'); ?>
</pre>