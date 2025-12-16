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
$kratos_global_host="blog.moeworld.tech";

// 多数情况下应当使用常量判断区域，并留出兜底行为，以防止在单域名站点出现问题
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


function kratos_custom_robots_txt_by_domain( $output, $public ) 
{
    /*
    // 原始的robots.txt内容
    User-agent: *
    Disallow: /wp-admin/
    Disallow: /wp-include/
    Disallow: /?s=
    Allow: /wp-admin/admin-ajax.php
    Sitemap: https://blog.moeworld.tech/sitemap.xml
    */

    // 默认规则（适用于没有匹配域名的情况）
    $default_rules  = "User-agent: *\n";
    $default_rules .= "Disallow: /wp-admin/\n";
    $default_rules .= "Disallow: /wp-include/\n";
    $default_rules .= "Disallow: /?s=\n";
    $default_rules .= "Allow: /wp-admin/admin-ajax.php\n";
    $default_rules .= "Sitemap: https://{$_SERVER['HTTP_HOST']}/sitemap.xml\n";

    // 大陆区域
    if ( defined('KRATOS_SITE_REGION') && KRATOS_SITE_REGION === 'REGION_CN' ) 
    {
        $rules  = "# As a condition of accessing this website, you agree to abide by the following\n";
        $rules .= "# content signals:\n";
        $rules .= "\n";
        $rules .= "# (a)  If a content-signal = yes, you may collect content for the corresponding\n";
        $rules .= "#      use.\n";
        $rules .= "# (b)  If a content-signal = no, you may not collect content for the\n";
        $rules .= "#      corresponding use.\n";
        $rules .= "# (c)  If the website operator does not include a content signal for a\n";
        $rules .= "#      corresponding use, the website operator neither grants nor restricts\n";
        $rules .= "#      permission via content signal with respect to the corresponding use.\n";
        $rules .= "\n";
        $rules .= "# The content signals and their meanings are:\n";
        $rules .= "\n";
        $rules .= "# search:   building a search index and providing search results (e.g., returning\n";
        $rules .= "#           hyperlinks and short excerpts from your website's contents). Search does not\n";
        $rules .= "#           include providing AI-generated search summaries.\n";
        $rules .= "# ai-input: inputting content into one or more AI models (e.g., retrieval\n";
        $rules .= "#           augmented generation, grounding, or other real-time taking of content for\n";
        $rules .= "#           generative AI search answers).\n";
        $rules .= "# ai-train: training or fine-tuning AI models.\n";
        $rules .= "\n";
        $rules .= "# ANY RESTRICTIONS EXPRESSED VIA CONTENT SIGNALS ARE EXPRESS RESERVATIONS OF\n";
        $rules .= "# RIGHTS UNDER ARTICLE 4 OF THE EUROPEAN UNION DIRECTIVE 2019/790 ON COPYRIGHT\n";
        $rules .= "# AND RELATED RIGHTS IN THE DIGITAL SINGLE MARKET.\n";
        $rules .= "\n";
        $rules .= "# BEGIN Cloudflare Managed content\n";
        $rules .= "\n";
        $rules .= "User-Agent: *\n";
        $rules .= "Content-signal: search=yes,ai-train=no\n";
        $rules .= "Allow: /\n";
        $rules .= "\n";
        $rules .= "User-agent: Amazonbot\n";
        $rules .= "Disallow: /\n";
        $rules .= "\n";
        $rules .= "User-agent: Applebot-Extended\n";
        $rules .= "Disallow: /\n";
        $rules .= "\n";
        $rules .= "User-agent: Bytespider\n";
        $rules .= "Disallow: /\n";
        $rules .= "\n";
        $rules .= "User-agent: CCBot\n";
        $rules .= "Disallow: /\n";
        $rules .= "\n";
        $rules .= "User-agent: ClaudeBot\n";
        $rules .= "Disallow: /\n";
        $rules .= "\n";
        $rules .= "User-agent: Google-Extended\n";
        $rules .= "Disallow: /\n";
        $rules .= "\n";
        $rules .= "User-agent: GPTBot\n";
        $rules .= "Disallow: /\n";
        $rules .= "\n";
        $rules .= "User-agent: meta-externalagent\n";
        $rules .= "Disallow: /\n";
        $rules .= "\n";
        $rules .= "# END Cloudflare Managed Content\n";
        $rules .= "\n";
        // $rules .= "User-agent: Google-Extended\n";
        // $rules .= "Disallow: /\n";
        $rules .= "User-agent: *\n";
        $rules .= "Disallow: /wp-admin/\n";
        $rules .= "Disallow: /wp-include/\n";
        $rules .= "Disallow: /?s=\n";
        $rules .= "Allow: /wp-admin/admin-ajax.php\n";
        $rules .= "Sitemap: https://blog.moeworld.tech/sitemap.xml\n";
        $rules .= "# Generate by moe-kratos-pjax";

        return $rules;
    }
    else
    {
        return $default_rules;
    }
}

add_filter( 'robots_txt', 'kratos_custom_robots_txt_by_domain', 10, 2 );

/**
 * 限制域名只能访问到对应区域的文章
 * 单篇访问时按域名 + 标签做强制访问控制
 */
function kratos_restrict_single_post_by_tag() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    // 当前访问域名
    $host = $_SERVER['HTTP_HOST'] ?? '';

    // 配置各域名允许看到哪些标签 slug
    $rules = [
        $kratos_china_host => ['area-cn','area-global'],
        $kratos_global_host => ['area-international','area-global'],
    ];

    // 如果这个域名没配置规则，则默认不限制
    if ( empty( $rules[$host] ) ) {
        return;
    }

    // 获取当前文章实际的标签 slug
    $post_tags = wp_get_post_tags( get_the_ID(), ['fields'=>'slugs'] );

    // 若文章不存在允许集合中，则返回 404/451
    $allowed_tags = $rules[$host];
    $intersect = array_intersect( $post_tags, $allowed_tags );
    if ( empty( $intersect ) ) {
        global $wp_query;
        // $wp_query->set_404();
        // status_header(404);
        status_header(451);
        nocache_headers();
        include get_query_template( '451' );
        exit;
    }
}
add_action( 'template_redirect', 'kratos_restrict_single_post_by_tag', 1 );


?>