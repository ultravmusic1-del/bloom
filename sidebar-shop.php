<?php
/**
 * Shop sidebar
 *
 * @package Bloom
 */

if ( ! is_active_sidebar( 'shop-sidebar' ) ) return;
?>

<aside id="secondary" class="widget-area site-sidebar shop-sidebar">
	<?php dynamic_sidebar( 'shop-sidebar' ); ?>
</aside>
