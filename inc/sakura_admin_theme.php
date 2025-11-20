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


?>