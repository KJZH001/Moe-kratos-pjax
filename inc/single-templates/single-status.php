<?php if(kratos_option('side_bar')=='left_side'){ ?>
<aside id="kratos-widget-area" class="col-md-4 hidden-xs hidden-sm scrollspy">
    <div id="sidebar" class="affix-top">
        <?php dynamic_sidebar('sidebar_tool'); ?>
    </div>
</aside>
<?php } ?>
<section id="main" class='<?php echo (kratos_option('side_bar')=='center')?'col-md-12':'col-md-8'; ?>'>
    <?php if(have_posts()){the_post();update_post_caches($posts); ?>
    <article>
        <div class="kratos-hentry kratos-post-inner clearfix">
            <div class="kratos-status kratos-status-post">
            <i class="fa fa-refresh"></i>
                <div class="kratos-status-inner">
                    <header><?php the_content() ?></header>
                    <footer><?php echo get_the_date();echo get_the_date(' H:i'); ?> • <?php comments_number('0','1','%');_e('条评论','moedog'); ?> • <?php echo kratos_get_post_views();_e('次阅读','moedog'); ?></footer>
                </div>
            </div>
        </div>
        <nav class="navigation post-navigation clearfix" role="navigation">
            <?php
            $prev_post = get_previous_post();
            if(!empty($prev_post)){ ?>
            <div class="nav-previous clearfix">
                <a title="<?php echo $prev_post->post_title;?>" href="<?php echo get_permalink($prev_post->ID); ?>">&lt; <?php _e('上一篇','moedog'); ?></a>
            </div>
            <?php }
            $next_post = get_next_post();
            if(!empty($next_post)){ ?>
            <div class="nav-next">
                <a title="<?php echo $next_post->post_title; ?>" href="<?php echo get_permalink($next_post->ID); ?>"><?php _e('下一篇','moedog'); ?> &gt;</a>
            </div>
            <?php } ?>
        </nav>
        <!-- 广告测试单元-文章横向 -->
        <div style="margin-top: 15px;
                    background-color: #fff;
                    box-shadow: 0 1px 2px rgba(0, 0, 0, .1);
                    border-radius: 0;
                    padding: 14px 14px 14px 14px;
                    background-color: rgba(253, 253, 253, .85) !important;" id="ad-bottom">
            <h4 style="font-size: 18px;
                    color: #666;
                    margin-top: 5px;">
                赞助商广告
            </h4>
            <p style="margin: 0 0 0px;
                    color: #888;
                    font-size: 16px;">
                如果您的网络和设备条件允许，这里可能会显示来自Google或其他赞助商的广告
            </p>
            <!-- 开始粘贴来自谷歌的代码 -->
            <!-- 广告代码被移动至footer中 -->
            <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6472836894788623"
                crossorigin="anonymous"></script> -->
            <!-- 底部横向广告 全局一次性推送ads只需要保留ins标签即可-->
            <!-- <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-6472836894788623"
                data-ad-slot="4637088625"
                data-ad-format="auto"
                data-full-width-responsive="true"></ins> -->
            <!-- <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script> -->
            <!-- 结束粘贴来自谷歌的代码 -->
            <!-- 第三方的广告 -->
            <a href="https://su.colac.fun?path=register&code=EouHPd4L" one-link-mark="yes" target="_blank">
                <img src="https://blog.moeworld.tech/wp-content/uploads/2024/09/可乐云_AD横_watermark.jpg" style="max-width: 100%; height: auto;">
            </a>
        </div>
        <!-- 广告测试单元-文章横向 结束 -->
        <?php comments_template(); ?>
    </article>
    <?php } ?>
</section>
<?php if(kratos_option('side_bar')=='right_side'){ ?>
    <aside id="kratos-widget-area" class="col-md-4 hidden-xs hidden-sm scrollspy">
        <div id="sidebar" class="affix-top">
            <?php dynamic_sidebar('sidebar_tool'); ?>
        </div>
    </aside>
<?php } ?>