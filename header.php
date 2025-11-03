<!DOCTYPE HTML>
<!--
     ____ _  __ __  __ __ __ ____
    /  _// |/ // / / // //_// __ \
   _/ / /    // /_/ // ,<  / /_/ /
  /___//_/|_/ \____//_/|_| \____/

-->
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta name="format-detection" content="telphone=no,email=no">
    <meta name="keywords" content="<?php kratos_keywords(); ?>">
    <meta name="description" itemprop="description" content="<?php kratos_description(); ?>">
    <meta property="og:title" content="<?php wp_title('-',true,'right'); ?>">
    <meta property="og:site_name" content="<?php wp_title('-',true,'right'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="<?php kratos_description(); ?>">
    <meta property="og:url" content="<?php if(!is_home()) echo get_permalink(); else echo get_bloginfo('home'); ?>">
    <meta name="twitter:title" content="<?php wp_title('-',true,'right'); ?>">
    <meta name="twitter:description" content="<?php kratos_description(); ?>">
    <meta name="twitter:card" content="summary">
    <?php rssinfo(); ?>
    <link rel="icon" type="image/x-icon" href="<?php echo kratos_option('site_ico'); ?>">
    <title><?php wp_title('-',true,'right'); ?></title>
    <?php wp_head();wp_print_scripts('theme-jq'); ?>
    <style><?php
        echo '#offcanvas-menu{background:rgba('.kratos_option('mobi_color').')}';
        if(kratos_option('head_mode')=='pic'){
            echo '.affix{top:61px}.kratos-cover.kratos-cover_2{background-image:url('.kratos_option('background_image').')}';
            if(kratos_option('background_image_mobi')) echo '@media(max-width:768px){.kratos-cover.kratos-cover_2{background-image:url('.kratos_option('background_image_mobi').')}}';
            if(kratos_option('mobi_mode')=='side') echo '@media(max-width:768px){#kratos-header-section{display:none}nav#offcanvas-menu{top:0;padding-top:40px}.kratos-cover .desc.desc2{margin-top:-55px}}';
        }
        if(kratos_option('background_mode')=='image') echo '@media(min-width:768px){.pagination>li>a{background-color:rgba(255,255,255,.8)}.kratos-hentry,.navigation div,.comments-area .comment-list li,#kratos-widget-area .widget,.comment-respond{background-color:rgba(253,253,253,.85)!important}.comment-list .children li{background-color:rgba(255,253,232,.7)!important}body.custom-background{background-image:url('.kratos_option('background_index_image').');background-size:cover;background-attachment:fixed}}';
        if(kratos_option('add_css')) echo kratos_option('add_css'); ?>
    </style>
    <!-- Google AdSense -->
    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8801574545913691"
     crossorigin="anonymous"></script> -->
    <!-- Google tag (gtag.js) Analytics-->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y9MJ3H1DDW"></script> -->
    <!-- Google Adsense 结束 -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-Y9MJ3H1DDW');
    </script>
  </head>
    <?php flush(); ?>
    <body <?php if(kratos_option('background_mode')=='image') echo 'class="custom-background"'; ?>>
        <div id="kratos-wrapper">
            <div id="kratos-page">
                <div id="kratos-header">
                    <?php if(has_nav_menu('header_menu')&&(kratos_option('head_mode')!='pic'||kratos_option('mobi_mode')=='side')): ?>
                    <div class="nav-toggle"><a class="kratos-nav-toggle js-kratos-nav-toggle"><i></i></a></div>
                    <?php endif; ?>
                    <header id="kratos-header-section"<?php if(kratos_option('head_mode')!='pic') echo ' class="color-banner" style="background:rgba('.kratos_option('banner_color').')"'; ?>>
                        <div class="container">
                            <div class="nav-header">
                                <?php if(kratos_option('head_mode')!='pic'): ?>
                                <div class="color-logo"><a href="<?php echo get_option('home'); ?>"><?php if(!kratos_option('banner_logo')) echo bloginfo('name'); else echo '<img src="'.kratos_option('banner_logo').'">'; ?></a></div>
                                <?php endif; ?>
                                <?php $defaults = array('theme_location'=>'header_menu','container'=>'nav','container_id'=>'kratos-menu-wrap','menu_class'=>'sf-menu','menu_id'=>'kratos-primary-menu',);
                                //wp_nav_menu($defaults); ?>
                                
                                <!-- 暂时性修复 2022.08.27 -->
                                <nav id="kratos-menu-wrap" class="menu-%e9%bb%98%e8%ae%a4%e8%8f%9c%e5%8d%95-container">
                                    <ul id="kratos-primary-menu" class="sf-menu">
                                        <li class="current-menu-item">
                                            <?php 
                                            if ( !( defined('KRATOS_SITE_REGION') && KRATOS_SITE_REGION === 'REGION_CN' ) )
                                            {   ?>
                                                <a href="https://blog.moeworld.tech" aria-current="page"><i class="fa fa-home"></i> 首页</a>
                                                <ul class="sub-menu">
                                                    <li><a href="https://blog.kzmxj.com" target="_blank"> 中国站</a></li>
                                                    <li><a href="https://blog.moeworld.tech" target="_blank"> 国际站</a></li>
                                                    <li><a href="https://project.moeworld.tech" target="_blank"> 空梦Project</a></li>
                                                </ul>
                                                <?php 
                                            }
                                            else 
                                            {   ?>
                                                <a href="https://blog.kzmxj.com" aria-current="page"><i class="fa fa-home"></i> 首页</a>
                                                <ul class="sub-menu">
                                                    <li><a href="https://blog.kzmxj.com" target="_blank"> 晓空blog</a></li>
                                                    <li><a href="https://project.moeworld.tech" target="_blank"> 空梦Project</a></li>
                                                </ul>
                                                <?php
                                            }?>
                                        </li>

                                        <li>
                                            <a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/archives/"><i class="fa fa-pencil"></i> 分类</a>
                                            <ul class="sub-menu">
                                            <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/laboratory/">实验室</a></li>
                                            <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/server/">服务器</a></li>
                                            <li>
                                                <a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/%E5%BC%80%E5%8F%91/">实用教程</a>
                                                <ul class="sub-menu">
                                                    <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/%e5%bc%80%e5%8f%91/">开发</a></li>
                                                    <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/%e5%bc%80%e5%8f%91/system/" >系统</a></li>
                                                    <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/yingjian/">硬件</a></li>
                                                    <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/%e5%bc%80%e5%8f%91/php/">php</a></li>
                                                    <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/%e5%bc%80%e5%8f%91/iapp/">iApp</a></li>
                                                    <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/%e5%bc%80%e5%8f%91/python/">Python</a></li>
                                                    <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/%e5%bc%80%e5%8f%91/wordpress/">WorldPress</a></li>
                                                    <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/%e5%bc%80%e5%8f%91/java-android/">Java&Android</a></li>
                                                </ul>
                                            </li>
                                                <li>
                                                    <a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/daily/">日常杂谈</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/daily/%e5%a4%a7%e5%ad%a6/">大学</a></li>
                                                        <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/daily/%e9%ab%98%e4%b8%ad/">高中</a></li>
                                                        <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/category/%e8%8a%82%e6%97%a5/">节日</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/archives/">文章归档</a></li>
                                                <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/sitemap.html">站点地图</a></li>
                                            </ul>
                                        </li>

                                        <li><a><i class="fa fa-cogs"></i> 工具</a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="javascript:;" target="_blank">站点监控</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="https://status.moeworld.top/" target="_blank">Uptime Selfhost</a></li>
                                                        <li><a href="https://stats.uptimerobot.com/J75mgc8yjM" target="_blank">Uptime Official</a></li>
                                                    </ul>
                                                </li>
                                                <?php if ( !( defined('KRATOS_SITE_REGION') && KRATOS_SITE_REGION === 'REGION_CN' ) ){ ?><li><a href="https://tiebasign.moeworld.top/" target="_blank">云签到</a></li><?php } ?>
                                                <li><a href="https://mikutap.moeworld.top/" target="_blank">Mikutap</a></li>
                                                <?php if ( !( defined('KRATOS_SITE_REGION') && KRATOS_SITE_REGION === 'REGION_CN' ) ){ ?><li><a href="https://outlook.com/?realm=moeworld.top" target="_blank">域名邮箱</a></li><?php } ?>
                                                <?php if ( !( defined('KRATOS_SITE_REGION') && KRATOS_SITE_REGION === 'REGION_CN' ) ){ ?><li><a href="https://blog.moeworld.tech/mirror.php" target="_blank">真&nbsp;·&nbsp;镜像站</a></li><?php } ?>
                                                <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/fortuneupup：测测今天的运势吧/" target="_blank">
                                                    幸运抽签</a></li>
                                                <li><a href="https://afdian.com/a/kjzh001" target="_blank" rel="nofollow">
                                                    爱发电
                                                </a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/friendshiplink/"><i class="fa fa-mars"></i> 友链</a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="https://www.travellings.cn/go.html" target="_blank">
                                                        开往
                                                    </a>
                                                </li>
                                                <li><a href="https://foreverblog.cn/go.html" target="_blank">虫洞</a></li>
                                                <li><a href="https://bf.zzxworld.com/s/1353" target="_blank">BlogFinder</a></li>
                                                <?php if ( !( defined('KRATOS_SITE_REGION') && KRATOS_SITE_REGION === 'REGION_CN' ) ){ ?><li><a href="https://blog.moeworld.tech/friendshiplink/" target="_blank">友情链接</a></li><?php } ?>
                                            </ul>
                                        </li>
                                        <?php if ( !( defined('KRATOS_SITE_REGION') && KRATOS_SITE_REGION === 'REGION_CN' ) ){ ?><li><a href="https://blog.moeworld.tech/guestbook/"><i class="fa fa-pencil"></i> 留言</a></li><?php } ?>

                                        <?php if ( !( defined('KRATOS_SITE_REGION') && KRATOS_SITE_REGION === 'REGION_CN' ) ){ ?>
                                        <li>
                                            <a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/订阅本站/"><i class="fa fa-rss-square"></i> 订阅</a>
                                            <ul class="sub-menu">    
                                                <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/feed/" target="_blank">原生RSS</a></li>
                                                <li><a href="https://rss.moeworld.tech/" target="_blank">RSSHub</a></li>
                                                <li><a href="https://blog.moeworld.tech/article_json.php" 
                                                        target="_blank">Json API</a></li>
                                                <li><a href="https://mp.weixin.qq.com/s/1LTNOCJYxeZnwMjiG2JlaA" target="_blank">微信公众号</a></li>
                                                <li><a href="http://qm.qq.com/cgi-bin/qm/qr?_wv=1027&k=tkyHXGo3TtbM8NPi6ti6LR3_Ufv8MtKO&authKey=2nCz6u1d%2Be%2FvumpuFryDAAn5Jf98cyqpdKh%2BXXxbO18p6T5jjH%2FjvbZixEAaIVFu&noverify=0&group_code=923991620" 
                                                        target="_blank">QQ群</a></li>
                                                <li><a href="https://t.me/akatsukisora" target="_blank">TG频道</a></li>
                                                <li><a href="https://t.me/amesekai" target="_blank">TG群组</a></li>
                                                <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/订阅本站/">使用说明</a></li>
                                            </ul>
                                        </li>
                                        <?php } ?>

                                        <li>
                                            <a href="https://about.moeworld.top" target="_blank"><i class="fa fa-rocket"></i> 关于</a>
                                            <ul class="sub-menu">
                                                        <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/about/">更多</a></li>
                                                        <li><a href="https://<?php echo $_SERVER['HTTP_HOST'];?>/about-2020/">更多-2020</a></li>
                                                        <li><a href="https://about.moeworld.top/" target="_blank">个人页</a></li>
                                            </ul>
                                        </li>

                                        <?php if ( !moe_kratos_should_hide_ads() ) : ?>
                                            <li>
                                                <a href="javascript:;" target="_blank"><i class="fa fa-magic"></i> Ai风月</a>
                                                <ul class="sub-menu">
                                                            <li><a href="http://coverstation.xyz?ref_id=e4d2eaab-d922-463b-b59b-c791a6b66a42" target="_blank" rel="nofollow">大陆服</a></li>
                                                            <li><a href="https://aigirlfriendstudio.com/?ref_id=e4d2eaab-d922-463b-b59b-c791a6b66a42" target="_blank" rel="nofollow">国际服</a></li>
                                                </ul>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </header>
                </div>
                <?php if(kratos_option('head_mode')=='pic'){ ?>
                <div class="kratos-start kratos-hero-2">
                    <div class="kratos-overlay"></div>
                    <div class="kratos-cover kratos-cover_2 text-center">
                        <div class="desc desc2 animate-box">
                            <a href="<?php echo get_bloginfo('url'); ?>"><h2><?php echo kratos_option('background_image_text1'); ?></h2><br><span><?php echo  kratos_option('background_image_text2'); ?></span></a>
                        </div>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="kratos-start kratos-hero"></div>
                <?php } ?>
                <div id="kratos-blog-post" <?php if(kratos_option('background_mode')=='color') echo 'style="background:'.kratos_option('background_index_color').'"'; ?>>