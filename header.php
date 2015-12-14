<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div class="row" id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package exhibit
 */

?>

<!DOCTYPE html>
<?php tha_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php tha_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php wp_title(); ?></title>
<?php tha_head_bottom(); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php tha_body_top(); ?>
	<div class="container" id="wrap">
		<?php tha_header_before(); ?>
		<header>
			<?php tha_header_top(); ?>
			<!-- maybe put navber here -->
			<hgroup class="siteinfo">
				<h2><a href="<?php echo esc_url( home_url() ) ?>" title="<?php bloginfo( 'title' ); ?>"><?php bloginfo( 'title' ); ?></a></h2>
				<h3 class="alt"><?php bloginfo( 'description' ); ?></h3>
			</hgroup>
			<?php tha_header_bottom(); ?>
		</header>
		<?php tha_header_after(); ?>
		<div class="row" id="content">
