<?php
/**
 * Kratos 自定义评论模板
 * 用于替代 comments_template()
 * 仅用于 page / 特定模板
 */
function kratos_comments_template( $args = [] ) {
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

?>