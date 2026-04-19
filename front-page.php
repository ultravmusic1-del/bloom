<?php
/**
 * Front page — loads correct homepage template or defaults to Homepage 1
 *
 * @package Bloom
 */

$template = get_page_template_slug();

if ( $template && file_exists( get_template_directory() . '/' . $template ) ) {
	include get_template_directory() . '/' . $template;
} else {
	include get_template_directory() . '/page-templates/template-homepage-1.php';
}
