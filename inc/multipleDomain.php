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

/** 根据区域显示文章列表 **/
//  area-cn                 代表    “区域：中国大陆”    （海外不可见）
//  area-international      代表    “区域：国际”        （大陆不可见）
//  area-global             代表    “区域：全球”        （全区域可见）
function kratos_filter_posts_by_area( $query ) {
    // 只在前端、主查询、文章列表类型（可按需加条件）执行
    if ( is_admin() || ! $query->is_main_query() ) 
    {
        return;
    }

    // 你可能只想在首页或文章归档生效，按需加条件，如：
    if ( is_home() || is_archive() || is_search() ) 
    {
        // 中国大陆：只显示 大陆和全球
        if ( defined('KRATOS_SITE_REGION') && KRATOS_SITE_REGION === 'REGION_CN' ) 
        {
            $tax_query = array(
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'slug',
                    'terms'    => array( 'area-cn','area-global' ),
                    'operator' => 'IN',
                ),
            );
        }
        // 国际区：仅不显示 大陆，无tag依然可以显示
        else
        {
            $tax_query = array(
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'slug',
                    'terms'    => array( 'area-cn' ),
                    'operator' => 'NOT IN',
                ),
            );
        }
        $query->set( 'tax_query', $tax_query );
    }
}
add_action( 'pre_get_posts', 'kratos_filter_posts_by_area', 10 );

/**
 * 获取主题资源 URL，但强制替换为当前请求的域名
 * 用于替换 get_template_directory_uri() 或 get_bloginfo('template_directory')
 *
 * @param string $path 主题目录下的相对路径（可空）
 * @return string 完整 URL
 */
function kratos_multi_domain_theme_uri( $path = '' ) {
    // 获取原始主题目录 URI（父主题目录）
    $orig_uri = get_template_directory_uri();  // 或者 get_stylesheet_directory_uri()，按你子主题/父主题实际情况
    
    // 解析该 URI
    $parts = wp_parse_url( $orig_uri );
    if ( false === $parts ) {
        // 解析失败，退回原始 URI
        $uri = $orig_uri;
    } else {
        // 构造新的 URI，替换 host 为当前请求的 HTTP_HOST
        $scheme = isset( $parts['scheme'] ) ? $parts['scheme'] : ( is_ssl() ? 'https' : 'http' );
        $host   = $_SERVER['HTTP_HOST'] ?? $parts['host'];
        $port   = isset( $parts['port'] ) ? ':' . $parts['port'] : '';
        $path0  = isset( $parts['path'] ) ? rtrim( $parts['path'], '/' ) : '';
        
        $uri = $scheme . '://' . $host . $port . $path0;
    }

    // 添加额外的路径
    if ( $path !== '' ) {
        // 确保在 URL 和 Path 之间只有一个 “/”
        $uri = rtrim( $uri, '/' ) . '/' . ltrim( $path, '/' );
    }

    return esc_url( $uri );
}

// 在中国大陆关闭RSS
function kratos_disable_feeds_for_cn_domain() {
    if ( defined('KRATOS_SITE_REGION') && KRATOS_SITE_REGION === 'REGION_CN' ) 
    {
        // 当请求的是 feed 路径
        if ( is_feed() ) {
            //返回 404
            global $wp_query;
            $wp_query->set_404();
            status_header(404);
            nocache_headers();
            include get_query_template('404');
            exit;
        }
    }
}
add_action('template_redirect', 'kratos_disable_feeds_for_cn_domain', 1);

// 移除 RSS 链接头
function kratos_remove_feed_links_for_cn() {
    if ( defined('KRATOS_SITE_REGION') && KRATOS_SITE_REGION === 'REGION_CN' ) 
    {
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
    }
}
add_action('init', 'kratos_remove_feed_links_for_cn');


?>