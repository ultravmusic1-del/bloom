<?php
/**
 * Sidebar template
 *
 * @package Bloom
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area site-sidebar">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
