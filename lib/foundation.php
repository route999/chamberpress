<?php
if ( ! function_exists( 'chamberpress_pagination' ) ) :
function chamberpress_pagination() {
	global $wp_query;
	$big = 999999999;
	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 5,
		'prev_next' => true,
	    'prev_text' => '&laquo;',
	    'next_text' => '&raquo;',
		'type' => 'list',
	) );

	$paginate_links = str_replace( "<ul class='page-numbers'>", "<ul class='pagination'>", $paginate_links );
	$paginate_links = str_replace( '<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links );
	$paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='current'><a href='#'>", $paginate_links );
	$paginate_links = str_replace( '</span>', '</a>', $paginate_links );
	$paginate_links = str_replace( "<li><a href='#'>&hellip;</a></li>", "<li><span class='dots'>&hellip;</span></li>", $paginate_links );
	$paginate_links = preg_replace( '/\s*page-numbers/', '', $paginate_links );
	if ( $paginate_links ) {
		echo '<div class="pagination-centered">';
		echo $paginate_links;
		echo '</div><!--// end .pagination -->';
	}
}
endif;


if ( ! function_exists( 'chamberpress_menu_fallback' ) ) :
function chamberpress_menu_fallback() {
	echo '<div class="alert-box secondary">';
	// Translators 1: Link to Menus, 2: Link to Customize.
		printf( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.',
			sprintf(  '<a href="%s">Menus</a>',
				get_admin_url( get_current_blog_id(), 'nav-menus.php' )
			),
			sprintf(  '<a href="%s">Customize</a>',
				get_admin_url( get_current_blog_id(), 'customize.php' )
			)
		);
		echo '</div>';
}
endif;

if ( ! function_exists( 'chamberpress_active_nav_class' ) ) :
function chamberpress_active_nav_class( $classes, $item ) {
	if ( 1 == $item->current || true == $item->current_item_ancestor ) {
		$classes[] = 'active';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'chamberpress_active_nav_class', 10, 2 );
endif;

if ( ! function_exists( 'chamberpress_active_list_pages_class' ) ) :
function chamberpress_active_list_pages_class( $input ) {

	$pattern = '/current_page_item/';
	$replace = 'current_page_item active';

	$output = preg_replace( $pattern, $replace, $input );

	return $output;
}
add_filter( 'wp_list_pages', 'chamberpress_active_list_pages_class', 10, 2 );
endif;

if ( ! class_exists( 'chamberpress_Comments' ) ) :
class chamberpress_Comments extends Walker_Comment{

	var $tree_type = 'comment';
	var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
	function __construct() { ?>

        <h3><?php comments_number( 'No Responses to', 'One Response to', '% Responses to' ); ?> &#8220;<?php the_title(); ?>&#8221;</h3>
        <ol class="comment-list">

    <?php }
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1; ?>

                <ul class="children">
    <?php }
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1; ?>

		</ul><!-- /.children -->

    <?php }
	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>

        <li <?php comment_class( $parent_class ); ?> id="comment-<?php comment_ID() ?>">
            <article id="comment-body-<?php comment_ID() ?>" class="comment-body">



		<header class="comment-author">

			<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>

			<div class="author-meta vcard author">

			<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ?>
			<time datetime="<?php echo comment_date( 'c' ) ?>"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( '%1$s', get_comment_date(),  get_comment_time() ) ?></a></time>

			</div><!-- /.comment-author -->

		</header>

                <section id="comment-content-<?php comment_ID(); ?>" class="comment">
                    <?php if ( ! $comment->comment_approved ) : ?>
                    		<div class="notice">
					<p class="bottom"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
				</div>
                    <?php else : comment_text(); ?>
                    <?php endif; ?>
                </section><!-- /.comment-content -->

                <div class="comment-meta comment-meta-data hide">
                    <a href="<?php echo htmlspecialchars( get_comment_link( get_comment_ID() ) ) ?>"><?php comment_date(); ?> at <?php comment_time(); ?></a> <?php edit_comment_link( '(Edit)' ); ?>
                </div><!-- /.comment-meta -->

                <div class="reply">
                    <?php $reply_args = array(
						'depth' => $depth,
						'max_depth' => $args['max_depth'],
						);

					comment_reply_link( array_merge( $args, $reply_args ) );  ?>
                </div><!-- /.reply -->
            </article><!-- /.comment-body -->

    <?php }

	function end_el(& $output, $comment, $depth = 0, $args = array() ) { ?>

        </li><!-- /#comment-' . get_comment_ID() . ' -->

    <?php }
	function __destruct() { ?>

    </ol><!-- /#comment-list -->

    <?php }
}
endif;
