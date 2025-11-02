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

?>