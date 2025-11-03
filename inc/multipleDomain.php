<?php
// 此文件用于为站点引入额外的多域名支持
// By 晓空
// 创建于2025.11.2

/** 判定区域状态 **/
/* 返回值有如下二种
 * REGION_CN        中国区
 * REGION_GLOBAL    国际区
 */

// 定义面向中国大陆的域名
$kratos_china_host="blog.kzmxj.com";
if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']==$kratos_china_host) {
    define('KRATOS_SITE_REGION','REGION_CN');
}
else
{
    define('KRATOS_SITE_REGION','REGION_GLOBAL');
}

/** 允许跨域请求 */

/** 根据区域显示文章列表 **/
// “area-cn” 代表“区域：中国大陆”（海外不可见）
// “area-international” 代表“区域：国际”（大陆不可见）
// “area-global” 代表“区域：全球”（全区域可见）
function kratos_filter_posts_by_area( $query ) {

    // 海外不生效
    if ( !( defined('KRATOS_SITE_REGION') && KRATOS_SITE_REGION === 'REGION_CN' ) ) 
    {
        return;
    }

    // 只在前端、主查询、文章列表类型（可按需加条件）执行
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    // 你可能只想在首页或文章归档生效，按需加条件，如：
    if ( is_home() || is_archive() || is_search() ) {
         // 设置 tax_query 以排除不相关区域
        $tax_query = array(
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'slug',
                // 'terms'    => array( 'area-international', 'area-global' ),
                'terms'    => array( 'area-international' ),
                'operator' => 'IN',
            ),
        );
        $query->set( 'tax_query', $tax_query );
    }
}
// add_action( 'pre_get_posts', 'kratos_filter_posts_by_area', 10 );


?>