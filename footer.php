                <footer>
                    <div id="footer"<?php echo ' style="background:rgba('.kratos_option('footer_color').')"'; ?>>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 footer-list text-center">
                                    <p class="kratos-social-icons"><?php
                                        echo (!kratos_option('social_weibo'))?'':'<a target="_blank" rel="nofollow" href="'.kratos_option('social_weibo').'"><i class="fa fa-weibo"></i></a>';
                                        echo (!kratos_option('social_tweibo'))?'':'<a target="_blank" rel="nofollow" href="'.kratos_option('social_tweibo').'"><i class="fa fa-tencent-weibo"></i></a>';
                                        echo (!kratos_option('social_mail'))?'':'<a target="_blank" rel="nofollow" href="'.kratos_option('social_mail').'"><i class="fa fa-envelope"></i></a>';
                                        echo (!kratos_option('social_twitter'))?'':'<a target="_blank" rel="nofollow" href="'.kratos_option('social_twitter').'"><i class="fa fa-twitter"></i></a>';
                                        echo (!kratos_option('social_facebook'))?'':'<a target="_blank" rel="nofollow" href="'.kratos_option('social_facebook').'"><i class="fa fa-facebook-official"></i></a>';
                                        echo (!kratos_option('social_linkedin'))?'':'<a target="_blank" rel="nofollow" href="'.kratos_option('social_linkedin').'"><i class="fa fa-linkedin-square"></i></a>';
                                        echo (!kratos_option('social_github'))?'':'<a target="_blank" rel="nofollow" href="'.kratos_option('social_github').'"><i class="fa fa-github"></i></a>'; ?>
                                    </p>
                                    <p> © <?php echo date('Y'); ?> <a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a>. All Rights Reserved. | <a href="https://icp.gov.moe/?keyword=20220268" target="_blank">萌ICP备20220268号</a> | <?php _e('已在风雨中度过','moedog'); ?> <span id="span_dt_dt">Loading...</span><br>Theme <a href="https://moedog.org/787.html" target="_blank" rel="nofollow">Kratos</a> Made by <a href="https://www.vtrois.com" target="_blank" rel="nofollow">Vtrois</a> Modified by <a href="https://moedog.org" target="_blank" rel="nofollow">Moedog</a> & <a href="https://blog.moeworld.tech" target="_blank" rel="nofollow">晓空</a><?php if(kratos_option('sitemap')) echo ' | <a href="'.get_option('home').'/sitemap.html" target="_blank">Sitemap</a>'; ?>
                                    <?php if(kratos_option('icp_num')) echo '<br><a href="https://beian.miit.gov.cn" rel="external nofollow" target="_blank">'.kratos_option('icp_num').'</a>';
                                          if(kratos_option('gov_num')) echo '<br><a href="'.kratos_option('gov_link').'" rel="external nofollow" target="_blank"><i class="govimg"></i>'.kratos_option('gov_num').'</a>'; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="cd-tool text-center">
                            <?php if(kratos_option('site_girl')&&!wp_is_mobile()){ ?><div class="<?php if(kratos_option('cd_weixin')) echo 'waifu-btn2 '; ?>waifu-btn" title="Waifu"><span class="fa fa-venus"></span></div><?php } ?>
                            <div class="<?php if(kratos_option('cd_weixin')) echo 'gotop-box2 '; ?>gotop-box"><div class="gotop-btn"><span class="fa fa-chevron-up"></span></div></div>
                            <?php if(kratos_option('cd_weixin')) echo '<div id="wechat-img" class="wechat-img"><span class="fa fa-weixin"></span><div id="wechat-pic"><img src="'.kratos_option('weixin_image').'"></div></div>'; ?>
                            <div class="search-box">
                                <span class="fa fa-search"></span>
                                <form class="search-form" role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
                                    <input type="text" name="s" id="search" placeholder="Search..." style="display:none"/>
                                </form>
                            </div>
                            <!--
                                Leaflow 对话
                                需要配合Leaflow插件使用
                                https://github.com/KJZH001/wp-amber.git
                            -->
                            <!-- <div class="moe-leaflow-box" id="moe-leaflow-amber-show-chat-button">
                                <span class="fa fa-reddit"></span> -->
                            </div>
                            <style>
                                .moe-leaflow-box 
                                {
                                    /* bottom: 230px; //230会把管理员编辑文章的按钮给正好盖住了= = */
                                    bottom: 280px;
                                    background: #848484;
                                    display: table;
                                    opacity: .7;
                                }
                            </style>
                        </div>
                        <?php if(kratos_option('site_girl')&&!wp_is_mobile()){ ?>
                        <div class="waifu">
                            <div class="waifu-tips"></div>
                            <canvas id="live2d" width="220" height="250" class="live2d"></canvas>
                            <div class="waifu-tool">
                                <span class="fa fa-home"></span>
                                <span class="fa fa-comments"></span>
                                <span class="fa fa-drivers-license-o"></span>
                                <span class="fa fa-street-view"></span>
                                <span class="fa fa-camera"></span>
                                <span class="fa fa-info-circle"></span>
                                <span class="fa fa-close"></span>
                            </div>
                        </div>
                        <?php }if(kratos_option('ap_footer')){ ?>
                        <div class="aplayer-footer">
                            <div id="ap-footer" data-json="<?php echo kratos_option('ap_json'); ?>" data-autoplay="<?php echo kratos_option('ap_autoplay'); ?>" data-loop="<?php echo kratos_option('ap_loop'); ?>" data-order="<?php echo kratos_option('ap_order'); ?>"></div>
                        </div>
                        <?php }if(kratos_option('site_snow')&&(!wp_is_mobile()||wp_is_mobile()&&kratos_option('snow_xb2016_mobile'))){ ?>
                        <div class="xb-snow">
                            <canvas id="Snow" data-count="<?php echo kratos_option('snow_xb2016_flakecount'); ?>" data-dist="<?php echo kratos_option('snow_xb2016_mindist'); ?>" data-color="<?php echo kratos_option('snow_xb2016_snowcolor'); ?>" data-size="<?php echo kratos_option('snow_xb2016_size'); ?>" data-speed="<?php echo kratos_option('snow_xb2016_speed'); ?>" data-opacity="<?php echo kratos_option('snow_xb2016_opacity'); ?>" data-step="<?php echo kratos_option('snow_xb2016_stepsize'); ?>"></canvas>
                        </div>
                        <?php } ?>
                    </div>
                </footer>
            </div>
        </div>
        <?php wp_footer();if(kratos_option('script_tongji')||kratos_option('add_script')){ ?>
        <script type="text/javascript">
            <?php echo kratos_option('script_tongji');echo kratos_option('add_script'); ?>
        </script>
        <?php } ?>
        <!-- 延迟加载Google Adsense_https://kerrynotes.com/implement-lazy-load-google-adsense/-->
            <!-- 
                滚动页面时再加载Google Adsense 
                此部分代码只需加载一次
                广告的原始位置只需保留ins部分即可
                2024.5.21 晓空
            -->
            <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6472836894788623"
                 crossorigin="anonymous"></script> -->
            <script type='text/javascript'> 
            /* 延迟加载 AdSense JS */
            var lazyadsense = !1;
            window.addEventListener("scroll", function() {
                (0 != document.documentElement.scrollTop && !1 === lazyadsense || 0 != document.body.scrollTop && !1 === lazyadsense) && (! function() {
                    var e = document.createElement("script");
                    // e.id = "g_ads_js", e.type = "text/javascript", e.async = "async", e.src = "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js";
                    e.id = "g_ads_js", e.type = "text/javascript", e.async = "async", e.src = "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6472836894788623";
                    var a = document.getElementsByTagName("script")[0];
                    a.parentNode.insertBefore(e, a)

                    /* 以下为自动广告专用，如果没有开启，请删除*/
                    // var gads = document.getElementById("g_ads_js")
                    // gads.setAttribute("data-ad-client", "ca-pub-6472836894788623");

                }(), lazyadsense = !0)
            }, !0);
            </script>
            <!-- 延迟加载广告推送 -->
            <script>
                try 
                {
                    (adsbygoogle = window.adsbygoogle || []).onload = function () {
                        [].forEach.call(document.getElementsByClassName('adsbygoogle'), function () {
                            adsbygoogle.push({})
                        })
                    }
                } 
                catch (error) 
                {
                    console.log('捕获到谷歌广告异常:', error.message);
                }
            </script>

        <!-- Adsense 全局代码 结束 -->

        <!-- 图片 lazyload 检查 -->
         <script>
            // 重载layload图片 在全局范围重新定义一次
            var lazyloadImageReload = function() {
                const lazyImages = document.querySelectorAll('img[data-src]');
                lazyImages.forEach(img => {
                    if (img.getBoundingClientRect().top <= window.innerHeight && img.getBoundingClientRect().bottom >= 0) {
                        img.src = img.getAttribute('data-src');
                        img.removeAttribute('data-src');
                    }
                });
            };

            // 在滚动事件中绑定懒加载逻辑
            // 强制每0.2秒检查一次，防止重复检查影响性能
            window.addEventListener('scroll', function() 
            {
                onScrollLazyLoad();
            });


            let throttleTimeout;
            // 定义滚动事件的回调函数
            function onScrollLazyLoad() 
            {
                if (!throttleTimeout) {
                    throttleTimeout = setTimeout(function() {
                        lazyloadImageReload();
                        throttleTimeout = null;

                        // 如果所有图片都已经懒加载完成，移除滚动事件监听器
                        if (document.querySelectorAll('img[data-src]').length === 0) {
                            window.removeEventListener('scroll', onScrollLazyLoad);
                        }
                    }, 200); // 每 200ms 检查一次
                }
            }

            /*
                可选：在页面加载完成后也执行一次检查
                但是咱感觉应该没必要吧？
            */ 
            // window.addEventListener('load', function() {
            //     lazyloadImageReload();
            // });

         </script>
        <!-- 图片 lazyload 检查  结束-->
    </body>
</html>