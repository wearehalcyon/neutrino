<h3><?php echo __('getMenu'); ?></h3>
<p><?php echo __('Function returns ready to use menu markup in HTML.'); ?></p>
<hr>
<p><?php echo __('<code>getMenu</code> Function source code:'); ?></p>
<pre class="code">
    function getMenu($name = null, $menu_id = null, $menu_class = null, $container = true){
        $menu = Menu::where('name', $name)->first();

        if ($menu) {
            $items = MenuItem::where([
                'menu_id' => $menu->id,
                'parent' => null,
            ])
            ->orderBy('order', 'ASC')
            ->get();

            if ($menu_id) {
                $menuID = ' id="' . $menu_id . '"';
            } else {
                $menuID = null;
            }

            if ($container) {
                $menuHtml = '<nav' . $menuID . ' class="menu-nav ' . $menu_class . '">';
                $menuHtml .= '<ul' . $menuID . ' class="menu-list ' . $menu_class . '">';
                foreach ($items as $item) {
                    // Get target
                    if ($item->target === 1) {
                        $target = ' target="_blank"';
                    } else {
                        $target = null;
                    }
                    // Set submenu class
                    $subItems = $item->getSubItems();
                    if ($subItems->isNotEmpty()) {
                        $menuHtml .= '<li class="menu-item menu-item-' . $item->id . ' menu-item-has-children">';
                    } else {
                        $menuHtml .= '<li class="menu-item menu-item-' . $item->id . '">';
                    }
                    // Check link type
                    if ($item->slug) {
                        $menuHtml .= '<a href="' . url($item->slug) . '" title="' . $item->name . '"' . $target . '>' . $item->name . '</a>';
                    } else {
                        $menuHtml .= '<a href="' . $item->url . '" title="' . $item->name . '"' . $target . '>' . $item->name . '</a>';
                    }

                    if ($subItems->isNotEmpty()) {
                        $menuHtml .= '<ul class="sub-menu">';
                        foreach ($subItems as $subItem) {
                            // Get target
                            if ($subItem->target === 1) {
                                $target = ' target="_blank"';
                            } else {
                                $target = null;
                            }
                            $menuHtml .= '<li class="sub-menu-item sub-menu-item-' . $subItem->id . '">';
                            if ($subItem->slug) {
                                $menuHtml .= '<a href="' . url($subItem->slug) . '" title="' . $subItem->name . '"' . $target . '>' . $subItem->name . '</a>';
                            } else {
                                $menuHtml .= '<a href="' . $subItem->url . '" title="' . $subItem->name . '"' . $target . '>' . $subItem->name . '</a>';
                            }
                            $menuHtml .= '</li>';
                        }
                        $menuHtml .= '</ul>';
                    }

                    $menuHtml .= '</li>';
                }
                $menuHtml .= '</ul>';
                $menuHtml .= '</nav>';
            } else {
                $menuHtml = '<ul' . $menuID . ' class="menu-list ' . $menu_class . '">';
                foreach ($items as $item) {
                    // Get target
                    if ($item->target === 1) {
                        $target = ' target="_blank"';
                    } else {
                        $target = null;
                    }
                    // Set submenu class
                    $subItems = $item->getSubItems();
                    if ($subItems->isNotEmpty()) {
                        $menuHtml .= '<li class="menu-item menu-item-' . $item->id . ' menu-item-has-children">';
                    } else {
                        $menuHtml .= '<li class="menu-item menu-item-' . $item->id . '">';
                    }
                    // Check link type
                    if ($item->slug) {
                        $menuHtml .= '<a href="' . url($item->slug) . '" title="' . $item->name . '"' . $target . '>' . $item->name . '</a>';
                    } else {
                        $menuHtml .= '<a href="' . $item->url . '" title="' . $item->name . '"' . $target . '>' . $item->name . '</a>';
                    }

                    if ($subItems->isNotEmpty()) {
                        $menuHtml .= '<ul class="sub-menu">';
                        foreach ($subItems as $subItem) {
                            // Get target
                            if ($subItem->target === 1) {
                                $target = ' target="_blank"';
                            } else {
                                $target = null;
                            }
                            $menuHtml .= '<li class="sub-menu-item sub-menu-item-' . $subItem->id . '">';
                            if ($subItem->slug) {
                                $menuHtml .= '<a href="' . url($subItem->slug) . '" title="' . $subItem->name . '"' . $target . '>' . $subItem->name . '</a>';
                            } else {
                                $menuHtml .= '<a href="' . $subItem->url . '" title="' . $subItem->name . '"' . $target . '>' . $subItem->name . '</a>';
                            }
                            $menuHtml .= '</li>';
                        }
                        $menuHtml .= '</ul>';
                    }

                    $menuHtml .= '</li>';
                }
                $menuHtml .= '</ul>';
            }
        }

        return $menuHtml ?? null;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getMenu</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getMenu($name = \'menu_name\', $menu_id = \'menu_id\', $menu_class = \'menu_class\', $container = \'false/true\')'); ?>
</pre>