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
                                <nav id="kratos-menu-wrap" class="menu-%e9%bb%98%e8%ae%a4%e8%8f%9c%e5%8d%95-container"><ul id="kratos-primary-menu" class="sf-menu"><li class="current-menu-item"><a href="https://blog.moeworld.tech" aria-current="page" one-link-mark="yes"><i class="fa fa-home"></i> 首页</a></li>
                                <li>
                                    <a href="https://blog.moeworld.tech/archives/" one-link-mark="yes"><i class="fa fa-pencil"></i> 分类</a>
                                    <ul class="sub-menu">
                                    <li><a href="https://blog.moeworld.tech/category/laboratory/" one-link-mark="yes">实验室</a></li>
                                    <li><a href="https://blog.moeworld.tech/category/server/" one-link-mark="yes">服务器</a></li>
                                        <li><a href="https://blog.moeworld.tech/category/%E5%BC%80%E5%8F%91/" one-link-mark="yes">实用教程</a>
                                            <ul class="sub-menu">
                                                <li><a href="https://blog.moeworld.tech/category/%e5%bc%80%e5%8f%91/" one-link-mark="yes">开发</a></li>
                                                <li><a href="https://blog.moeworld.tech/category/%e5%bc%80%e5%8f%91/system/" one-link-mark="yes">系统</a></li>
                                                <li><a href="https://blog.moeworld.tech/category/yingjian/" one-link-mark="yes">硬件</a></li>
                                                <li><a href="https://blog.moeworld.tech/category/%e5%bc%80%e5%8f%91/php/" one-link-mark="yes">php</a></li>
                                                <li><a href="https://blog.moeworld.tech/category/%e5%bc%80%e5%8f%91/iapp/" one-link-mark="yes">iApp</a></li>
                                                <li><a href="https://blog.moeworld.tech/category/%e5%bc%80%e5%8f%91/python/" one-link-mark="yes">Python</a></li>
                                                <li><a href="https://blog.moeworld.tech/category/%e5%bc%80%e5%8f%91/wordpress/" one-link-mark="yes">WorldPress</a></li>
                                                <li><a href="https://blog.moeworld.tech/category/%e5%bc%80%e5%8f%91/java-android/" one-link-mark="yes">Java&Android</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="https://blog.moeworld.tech/category/daily/" one-link-mark="yes">日常杂谈</a>
                                            <ul class="sub-menu">
                                                <li><a href="https://blog.moeworld.tech/category/daily/%e5%a4%a7%e5%ad%a6/" one-link-mark="yes">大学</a></li>
                                                <li><a href="https://blog.moeworld.tech/category/daily/%e9%ab%98%e4%b8%ad/" one-link-mark="yes">高中</a></li>
                                                <li><a href="https://blog.moeworld.tech/category/%e8%8a%82%e6%97%a5/" one-link-mark="yes">节日</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="https://blog.moeworld.tech/archives/" one-link-mark="yes">文章归档</a></li>
                                        <li><a href="https://blog.moeworld.tech/sitemap.html" one-link-mark="yes">站点地图</a></li>
                                    </ul>
                                </li>

                                <li><a one-link-mark="yes"><i class="fa fa-cogs"></i> 工具</a>
                                    <ul class="sub-menu">
                                        <!--<li><a href="https://blog.moeworld.tech/rcraft-api/" one-link-mark="yes">Api接口</a></li>-->
                                        <li>
                                            <a href="https://blog.moeworld.tech/" one-link-mark="yes" target="_blank">站点监控</a>
                                            <ul class="sub-menu">
                                                <!-- <li><a href="https://uptime.lovemoe.net/" one-link-mark="yes" target="_blank">Kuma</a></li> -->
                                                <li><a href="https://status.moeworld.top/" one-link-mark="yes" target="_blank">Uptime Selfhost</a></li>
                                                <li><a href="https://stats.uptimerobot.com/J75mgc8yjM" one-link-mark="yes" target="_blank">Uptime Official</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="https://tiebasign.moeworld.top/" one-link-mark="yes" target="_blank">云签到</a></li>
                                        <li><a href="https://mikutap.moeworld.top/" one-link-mark="yes" target="_blank">Mikutap</a></li>
                                        <li><a href="https://outlook.com/?realm=moeworld.top" one-link-mark="yes" target="_blank">域名邮箱</a></li>
                                        <li><a href="https://blog.moeworld.tech/fortuneupup：测测今天的运势吧/" one-link-mark="yes" target="_blank">
                                            幸运抽签</a></li>
                                        <li><a href="https://afdian.net/a/kjzh001" one-link-mark="yes" target="_blank"><i class="fa fa-shopping-cart"></i> 爱发电</a></li>
                                    </ul>
                                </li>
                                <li><a href="https://blog.moeworld.tech/friendshiplink/" one-link-mark="yes"><i class="fa fa-mars"></i> 友链</a></li>
                                <li><a href="https://blog.moeworld.tech/guestbook/" one-link-mark="yes"><i class="fa fa-pencil"></i> 留言</a></li>
                                <li><a href="https://travellings.link" one-link-mark="yes" target="_blank"><i class="fa fa-paper-plane"></i> 开往</a>
                                    <ul class="sub-menu">
                                        <li><a href="https://foreverblog.cn/go.html" one-link-mark="yes" target="_blank">虫洞</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="https://blog.moeworld.tech/订阅本站/" one-link-mark="yes"><i class="fa fa-rss-square"></i> 订阅</a>
                                    <ul class="sub-menu">    
                                        <li><a href="https://blog.moeworld.tech/feed/" one-link-mark="yes" target="_blank">原生RSS</a></li>
                                        <li><a href="https://rss.moeworld.tech/" one-link-mark="yes" target="_blank">RSSHub</a></li>
                                        <li><a href="https://blog.moeworld.tech/article_json.php" 
                                                one-link-mark="yes" target="_blank">Json API</a></li>
                                                <li><a href="https://mp.weixin.qq.com/s/1LTNOCJYxeZnwMjiG2JlaA" one-link-mark="yes" target="_blank">微信公众号</a></li>
                                        <li><a href="http://qm.qq.com/cgi-bin/qm/qr?_wv=1027&k=tkyHXGo3TtbM8NPi6ti6LR3_Ufv8MtKO&authKey=2nCz6u1d%2Be%2FvumpuFryDAAn5Jf98cyqpdKh%2BXXxbO18p6T5jjH%2FjvbZixEAaIVFu&noverify=0&group_code=923991620" 
                                                one-link-mark="yes" target="_blank">QQ群</a></li>
                                        <li><a href="https://t.me/akatsukisora" one-link-mark="yes" target="_blank">TG频道</a></li>
                                        <li><a href="https://t.me/amesekai" one-link-mark="yes" target="_blank">TG群组</a></li>
                                        <li><a href="https://blog.moeworld.tech/订阅本站/" one-link-mark="yes">使用说明</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="https://about.moeworld.top" one-link-mark="yes" target="_blank"><i class="fa fa-rocket"></i> 关于</a>
                                    <ul class="sub-menu">
                                                <li><a href="https://blog.moeworld.tech/about/" one-link-mark="yes">更多</a></li>
                                                <li><a href="https://blog.moeworld.tech/about-2020/" one-link-mark="yes">更多-2020</a></li>
                                                <li><a href="https://about.moeworld.top/" one-link-mark="yes" target="_blank">个人页</a></li>
                                    </ul>
                                </li>
                                </ul></nav>



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