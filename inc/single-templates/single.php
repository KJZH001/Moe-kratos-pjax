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
        <!-- 广告单元-文章顶部 -->
        <?php if ( ! moe_kratos_should_hide_ads() ) : ?>
            <div style="margin-top: 15px;
                margin-bottom: 16px;
                background-color: #fff;
                box-shadow: 0 1px 2px rgba(0, 0, 0, .1);
                border-radius: 0;
                padding: 14px 14px 14px 14px;
                background-color: rgba(253, 253, 253, .85) !important;" id="ad-article-top">
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
                <a href="https://aigirlfriendstudio.com/?ref_id=e4d2eaab-d922-463b-b59b-c791a6b66a42" one-link-mark="yes" target="_blank">
                    <img src="https://blog.moeworld.tech/wp-content/uploads/2025/06/AI风月-700x160-1.png" style="max-width: 100%; height: auto;">
                </a>
            </div>
        <?php endif; ?>
        <!-- 广告单元-文章顶部 结束 -->
        <div class="kratos-hentry kratos-post-inner clearfix">
            <header class="kratos-entry-header">
                <h1 class="kratos-entry-title text-center"><?php the_title(); ?></h1>
                <div class="kratos-post-meta text-center">
                    <span>
                    <i class="fa fa-calendar"></i> <?php echo get_the_date(); ?>
                    <i class="fa fa-commenting-o"></i> <?php comments_number('0','1','%');_e('条评论','moedog'); ?>
                    <i class="fa fa-eye"></i> <?php echo kratos_get_post_views();_e('次阅读','moedog'); ?>  
                    <span class="hd">
                    <i class="fa fa-thumbs-o-up"></i> <?php if(get_post_meta($post->ID,'love',true)){echo get_post_meta($post->ID,'love',true);}else{echo '0'; }_e('人点赞','moedog'); ?>
                    <i class="fa fa-user"></i> <?php the_author(); ?>
                    </span>
                    </span>
                </div>
            </header>
            <div class="kratos-post-content">
            <?php the_content(); ?>
            </div>
            <?php if(kratos_option('post_cc')){ ?>
            <div class="kratos-copyright text-center clearfix">
                <h5><?php _e('本作品采用 <a rel="license nofollow" target="_blank" href="http://creativecommons.org/licenses/by-sa/4.0/">知识共享署名-相同方式共享 4.0 国际许可协议</a> 进行许可','moedog'); ?></h5>
            </div>
            <?php } ?>
            <footer class="kratos-entry-footer clearfix">
                <div class="post-like-donate text-center clearfix" id="post-like-donate">
                <?php if(kratos_option('post_like_donate')) echo '<a href="javascript:;" class="Donate"><i class="fa fa-bitcoin"></i> '.__('打赏','moedog').'</a>'; ?>
                   <a href="javascript:;" id="btn" data-action="love" data-id="<?php the_ID() ?>" class="Love<?php if(isset($_COOKIE['love_'.$post->ID])) echo ' done';?>"><i class="fa fa-thumbs-o-up"></i> <?php _e('点赞','moedog'); ?></a>
                <?php if(kratos_option('post_share')) {
                    echo '<a href="javascript:;" class="Share"><i class="fa fa-share-alt"></i> '.__('分享','moedog').'</a>';
                    require_once(get_template_directory().'/inc/share.php');
                } ?>
                </div>
                <div class="footer-tag clearfix">
                    <div class="pull-left">
                    <i class="fa fa-tags"></i>
                    <?php if(get_the_tags()){the_tags('',' ','');}else{echo '<a>No Tag</a>';}?>
                    </div>
                    <div class="pull-date">
                    <span><?php _e('最后编辑：','moedog');the_modified_date();?></span>
                    </div>
                </div>
            </footer>
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
        <!-- 广告单元-文章横向 -->
        <?php if ( ! moe_kratos_should_hide_ads() ) : ?>
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
                <!-- 第三方的广告 -->
                <a href="https://su.colac.fun?path=register&code=EouHPd4L" one-link-mark="yes" target="_blank">
                    <img src="https://blog.moeworld.tech/wp-content/uploads/2024/09/可乐云_AD横_watermark.jpg" style="max-width: 100%; height: auto;">
                </a>
            </div>
        <?php endif; ?>
        <!-- 广告单元-文章横向 结束 -->
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