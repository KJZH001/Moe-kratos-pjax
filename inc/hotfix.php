<?php
/**
 * Kratos 自定义评论模板
 * 用于替代 comments_template()
 * 仅用于 page / 特定模板
 */
function kratos_comments_template_version_1( $args = [] ) {
    global $post;

    if ( ! $post ) {
        return;
    }

    // 1. 手动获取评论（不走 comments_template 内部流程）
    $comments = get_comments( array_merge([
        'post_id' => $post->ID,
        'status'  => 'approve',
        'order'   => 'ASC',
        'orderby' => 'comment_date_gmt',
        'number'  => 0,
    ], $args) );

    // 2. 输出评论列表
    if ( ! empty( $comments ) ) {
        echo '<ol class="comment-list">';
        wp_list_comments([
            'style'      => 'ol',
            'avatar_size'=> 48,
            'short_ping' => true,
        ], $comments);
        echo '</ol>';
    }

    // 3. 输出评论表单
    comment_form();
}

function kratos_comments_template_clean( $file = '/comments.php' ) {
    global $post;

    if ( ! $post || ( ! is_single() && ! is_page() ) ) {
        return;
    }

    $comment_args = [
        'post_id' => $post->ID,
        'status'  => 'approve',
        'orderby' => 'comment_date_gmt',
        'order'   => 'ASC',
    ];

    if ( get_option( 'thread_comments' ) ) {
        $comment_args['hierarchical'] = 'threaded';
    }

    if ( is_user_logged_in() ) {
        $comment_args['include_unapproved'] = [ get_current_user_id() ];
    } else {
        $email = wp_get_unapproved_comment_author_email();
        if ( $email ) {
            $comment_args['include_unapproved'] = [ $email ];
        }
    }

    $comments = get_comments( $comment_args );

    // 🔽 这里直接传 $comments 给模板
    $theme_template = trailingslashit( get_stylesheet_directory() ) . $file;

    if ( file_exists( $theme_template ) ) {
        require $theme_template;
    }
}




?>