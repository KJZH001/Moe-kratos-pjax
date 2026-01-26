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

function kratos_comments_template( $file = '/comments.php', $separate_comments = false ) {
	global $wp_query, $withcomments, $post, $wpdb, $id, $comment, $user_login, $user_identity, $overridden_cpage, $wp_stylesheet_path, $wp_template_path;

	if ( ! ( is_single() || is_page() || $withcomments ) || empty( $post ) ) {
		return;
	}

	if ( empty( $file ) ) {
		$file = '/comments.php';
	}

	$req = get_option( 'require_name_email' );

	/*
	 * Comment author information fetched from the comment cookies.
	 */
	$commenter = wp_get_current_commenter();

	/*
	 * The name of the current comment author escaped for use in attributes.
	 * Escaped by sanitize_comment_cookies().
	 */
	$comment_author = $commenter['comment_author'];

	/*
	 * The email address of the current comment author escaped for use in attributes.
	 * Escaped by sanitize_comment_cookies().
	 */
	$comment_author_email = $commenter['comment_author_email'];

	/*
	 * The URL of the current comment author escaped for use in attributes.
	 */
	$comment_author_url = esc_url( $commenter['comment_author_url'] );

	$comment_args = array(
		'orderby'       => 'comment_date_gmt',
		'order'         => 'ASC',
		'status'        => 'approve',
		'post_id'       => $post->ID,
		'no_found_rows' => false,
	);

	if ( get_option( 'thread_comments' ) ) {
		$comment_args['hierarchical'] = 'threaded';
	} else {
		$comment_args['hierarchical'] = false;
	}

	if ( is_user_logged_in() ) {
		$comment_args['include_unapproved'] = array( get_current_user_id() );
	} else {
		$unapproved_email = wp_get_unapproved_comment_author_email();

		if ( $unapproved_email ) {
			$comment_args['include_unapproved'] = array( $unapproved_email );
		}
	}

	$per_page = 0;
	if ( get_option( 'page_comments' ) ) {
		$per_page = (int) get_query_var( 'comments_per_page' );
		if ( 0 === $per_page ) {
			$per_page = (int) get_option( 'comments_per_page' );
		}

		$comment_args['number'] = $per_page;
		$page                   = (int) get_query_var( 'cpage' );

		if ( $page ) {
			$comment_args['offset'] = ( $page - 1 ) * $per_page;
		} elseif ( 'oldest' === get_option( 'default_comments_page' ) ) {
			$comment_args['offset'] = 0;
		} else {
			// If fetching the first page of 'newest', we need a top-level comment count.
			$top_level_query = new WP_Comment_Query();
			$top_level_args  = array(
				'count'   => true,
				'orderby' => false,
				'post_id' => $post->ID,
				'status'  => 'approve',
			);

			if ( $comment_args['hierarchical'] ) {
				$top_level_args['parent'] = 0;
			}

			if ( isset( $comment_args['include_unapproved'] ) ) {
				$top_level_args['include_unapproved'] = $comment_args['include_unapproved'];
			}

			/**
			 * Filters the arguments used in the top level comments query.
			 *
			 * @since 5.6.0
			 *
			 * @see WP_Comment_Query::__construct()
			 *
			 * @param array $top_level_args {
			 *     The top level query arguments for the comments template.
			 *
			 *     @type bool         $count   Whether to return a comment count.
			 *     @type string|array $orderby The field(s) to order by.
			 *     @type int          $post_id The post ID.
			 *     @type string|array $status  The comment status to limit results by.
			 * }
			 */
			$top_level_args = apply_filters( 'comments_template_top_level_query_args', $top_level_args );

			$top_level_count = $top_level_query->query( $top_level_args );

			$comment_args['offset'] = ( (int) ceil( $top_level_count / $per_page ) - 1 ) * $per_page;
		}
	}

	/**
	 * Filters the arguments used to query comments in comments_template().
	 *
	 * @since 4.5.0
	 *
	 * @see WP_Comment_Query::__construct()
	 *
	 * @param array $comment_args {
	 *     Array of WP_Comment_Query arguments.
	 *
	 *     @type string|array $orderby                   Field(s) to order by.
	 *     @type string       $order                     Order of results. Accepts 'ASC' or 'DESC'.
	 *     @type string       $status                    Comment status.
	 *     @type array        $include_unapproved        Array of IDs or email addresses whose unapproved comments
	 *                                                   will be included in results.
	 *     @type int          $post_id                   ID of the post.
	 *     @type bool         $no_found_rows             Whether to refrain from querying for found rows.
	 *     @type bool         $update_comment_meta_cache Whether to prime cache for comment meta.
	 *     @type bool|string  $hierarchical              Whether to query for comments hierarchically.
	 *     @type int          $offset                    Comment offset.
	 *     @type int          $number                    Number of comments to fetch.
	 * }
	 */
	$comment_args = apply_filters( 'comments_template_query_args', $comment_args );

	$comment_query = new WP_Comment_Query( $comment_args );
	$_comments     = $comment_query->comments;

	// Trees must be flattened before they're passed to the walker.
	if ( $comment_args['hierarchical'] ) {
		$comments_flat = array();
		foreach ( $_comments as $_comment ) {
			$comments_flat[]  = $_comment;
			$comment_children = $_comment->get_children(
				array(
					'format'  => 'flat',
					'status'  => $comment_args['status'],
					'orderby' => $comment_args['orderby'],
				)
			);

			foreach ( $comment_children as $comment_child ) {
				$comments_flat[] = $comment_child;
			}
		}
	} else {
		$comments_flat = $_comments;
	}

	/**
	 * Filters the comments array.
	 *
	 * @since 2.1.0
	 *
	 * @param array $comments Array of comments supplied to the comments template.
	 * @param int   $post_id  Post ID.
	 */
	$wp_query->comments = apply_filters( 'comments_array', $comments_flat, $post->ID );

	$comments                        = &$wp_query->comments;
	$wp_query->comment_count         = count( $wp_query->comments );
	$wp_query->max_num_comment_pages = $comment_query->max_num_pages;

	if ( $separate_comments ) {
		$wp_query->comments_by_type = separate_comments( $comments );
		$comments_by_type           = &$wp_query->comments_by_type;
	} else {
		$wp_query->comments_by_type = array();
	}

	$overridden_cpage = false;

	if ( '' === get_query_var( 'cpage' ) && $wp_query->max_num_comment_pages > 1 ) {
		set_query_var( 'cpage', 'newest' === get_option( 'default_comments_page' ) ? get_comment_pages_count() : 1 );
		$overridden_cpage = true;
	}

	if ( ! defined( 'COMMENTS_TEMPLATE' ) ) {
		define( 'COMMENTS_TEMPLATE', true );
	}

	$theme_template = trailingslashit( $wp_stylesheet_path ) . $file;

	/**
	 * Filters the path to the theme template file used for the comments template.
	 *
	 * @since 1.5.1
	 *
	 * @param string $theme_template The path to the theme template file.
	 */
	$include = apply_filters( 'comments_template', $theme_template );

	if ( file_exists( $include ) ) {
		require $include;
	} elseif ( file_exists( trailingslashit( $wp_template_path ) . $file ) ) {
		require trailingslashit( $wp_template_path ) . $file;
	} else { // Backward compat code will be removed in a future release.
		require ABSPATH . WPINC . '/theme-compat/comments.php';
	}
}


?>