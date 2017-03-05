<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DEPC_template_theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700|Lato:400,400italic' rel='stylesheet' type='text/css'>

<!-- TEMP libraries: TODO: Make library and asset inclusion by gulp -->
<script src="<?php bloginfo('template_url');?>/assets/libs/slick.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/assets/libs/slick.css"/>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'depc' ); ?></a>

	<?php get_sidebar('header-display');?>

	<!-- FOUNDATION TOPBAR responsive nav -->
	<nav id="masthead" class="site-header top-bar row" data-topbar>
		<div class="site-branding columns medium-3 medium-push-1">
			<ul class="title-area">
				<li class="name site-title">
					<h1>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img class="logo" src="<?php bloginfo('template_url');?>/assets/imgs/uiPromos_logo.png" alt="hick-up">
							<!-- <img class="logo-type" src="<?php //bloginfo('template_url');?>/assets/imgs/WreckCheck_Logo_Type.png" alt="<?php //bloginfo( 'name' ); ?>"> -->
						</a>
					</h1>
				</li>
				<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
			</ul>
		</div><!-- .site-branding -->
		<!-- <div class="site-navigation-derp columns medium-3 medium-pull-1"></div> -->
		<div class="main-navigation top-bar-section columns small-12 medium-6 medium-pull-1" role="navigation">
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu' => 'Primary Menu',
				'container' => false,
				'items_wrap' => '<ul id="site-navigation" class="main-nav right">%3$s</ul>'
			) ); ?>
		</div><!-- #site-navigation -->
	</nav>
	<!-- END TOPBAR responsive nav -->

	<div id="content" class="site-content row">
