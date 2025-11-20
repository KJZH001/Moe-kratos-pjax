<?php
/* 
 * 将 樱花庄 主题 移植到 moe-kratos-pjax
 * by 晓空 2025.11.20
 */

// 注册后台配色方案
function kratos_sakura_dash_scheme($key, $name, $col1, $col2, $col3, $col4, $base, $focus, $current, $rules = '') {
    $hash = 'color_1=' . str_replace('#', '', $col1) .
            '&color_2=' . str_replace('#', '', $col2) .
            '&color_3=' . str_replace('#', '', $col3) .
            '&color_4=' . str_replace('#', '', $col4) .
            '&rules=' . urlencode($rules);
    wp_admin_css_color(
        $key,
        $name,
        // 因为反正也没指望从域名能进后台，就这样吧
        get_template_directory_uri() . '/inc/dash-scheme.php?' . $hash,
        array($col1, $col2, $col3, $col4),
        array('base' => $base, 'focus' => $focus, 'current' => $current)
    );
}

function kratos_register_sakura_admin_scheme() {
    kratos_sakura_dash_scheme(
        'sakura',                   // 配色方案关键字
        'Sakura',                   // 显示名称
        '#8fbbb1', '#bfd8d2', '#fedcd2', '#df744a', // 四个主要色调
        '#e5f8ff', '#ffffff', '#ffffff',           // 基础色、焦点色、当前色
        // 自定义 CSS 规则：修改菜单文字颜色、设置后台背景图等
        '#adminmenu .wp-has-current-submenu .wp-submenu a,#adminmenu .wp-has-current-submenu.opensub .wp-submenu a,#adminmenu .wp-submenu a,#adminmenu a.wp-has-current-submenu:focus+.wp-submenu a,#wpadminbar .ab-submenu .ab-item,#wpadminbar .quicklinks .menupop ul li a,#wpadminbar .quicklinks .menupop.hover ul li a,#wpadminbar.nojs .quicklinks .menupop:hover ul li a,.folded #adminmenu .wp-has-current-submenu .wp-submenu a{color:#f3f2f1}body{background-image:url(https://view.moezx.cc/images/2018/01/29/FLOWER.jpg);background-attachment:fixed;}#wpcontent{background:rgba(255,255,255,.6)}'
    );
}
add_action('admin_init', 'kratos_register_sakura_admin_scheme');



?>