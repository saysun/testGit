<?php
$display_header 	= tdt_is_yes_or_one( tdt_get_page_theme_option( "header_show_header", "header-show-header" ) );
//$header_style 		= tdt_get_page_theme_option( "header_style", "header-style" );
$header_style        = 'style-1';
$topbar_phone 		= tdt_get_theme_mod_value( "header-infobar-phone" );
$topbar_email 		= tdt_get_theme_mod_value( "header-infobar-email" );

$show_menu 			= tdt_is_yes_or_one( tdt_get_page_theme_option( 'header_show_menu', 'header-show-menu' ) );
$enable_sticky 		= tdt_is_yes_or_one( tdt_get_page_theme_option( 'header_menu_sticky', 'header-menu-sticky' ) );
$display_breadcrumb = tdt_is_yes_or_one( tdt_get_page_theme_option( 'header_breadcrumb_show', 'header-breadcrumb-show' ) );

$slider_type 		= tdt_get_page_theme_option( "slider_type", null );

$slider = "";
if ( $slider_type == "layer" ) {
	$slider 		= tdt_get_page_theme_option( "layerslider", null );
}
else if ( $slider_type == "rev" ) {
	$slider 		= tdt_get_page_theme_option( "revslider", null );
}
else if ( $slider_type == "custom" ) {
	$slider 		= tdt_get_page_theme_option( "custom_slider", null );
}

$slider_nav = false;

//if ( ( is_page() || is_single() ) ) {
//	$slider_nav = true;
//}

?>

<?php if ( $display_header ) { ?>
<header id="tdt-header" class="<?php echo "header-" . esc_attr( $header_style ); ?> <?php if ( $slider_nav ) echo "slider-nav"; ?> <?php if ( $enable_sticky ) echo "enable-sticky"; ?>">
	<nav>
		<div class="mobile-nav">
		<p class="menu-word">MENU</p>
			<button type="button" id="navbar-toggle" class="toggle-button" data-target="mobile-menu-container">
				<span class="sr-only">Toggle navigation</span>
				<div class="site-header-icon-nav">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</button>
		</div>

		<div id="logo-header">
			<a class="logo" href="<?php echo esc_url( get_home_url() ) ?>">
			<?php
                $logo_main = tdt_get_theme_mod_value("header-logo");
				$blog_title = get_bloginfo();
                if ( empty($logo_main) ) {
				
                    echo $blog_title;
                }
                else {
                    $logo_img = $logo_main;
					echo '<img src="' . esc_url( $logo_img ) . '" alt="Logo" />';
                }
                ?>
                
			</a>
		</div>

		<div class="nav-wrapper">
		<?php
			if ( $show_menu ) {
				$tdt_pmenu = tdt_get_page_theme_option( 'header_menu', null );
				if ( $tdt_pmenu !== "secondary-menu" ) {
					$tdt_pmenu = "main-menu";
				}
				if ( has_nav_menu( $tdt_pmenu ) ) {
					wp_nav_menu(
						array(
							'theme_location' => $tdt_pmenu,
							'container_id'	=>	'main-menu-wrapper',
							'container_class' => 'main-menu',
							'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'walker' => new Beau_Nav_Walker()
						)
					);
				} else {
					echo '<div id="menu-not-assigned">Assign a menu</div>';
				}
			}
		?>
		</div>
	</nav>
</header>
<?php } /* end of display header condition check */ ?>

<?php if ( !is_home() && $display_breadcrumb ) { ?>



<div class="tdt-page-title" style="height:100vh" >


<?php if (get_post_meta(get_the_ID(), "tdt_videobg", true)) { ?>
<script>

jQuery(document).ready(function($){


$('#video').YTPlayer({
    fitToBackground: true,
    videoId: '<?php echo get_post_meta(get_the_ID(), "tdt_videobg", true); ?>'
});

});

</script>

<div id="video"></div>

<?php } ?>

    <div class="title-wrapper">
	
	<?php if ( is_page()) { ?>
	
 <?php if ( is_singular() && get_post_meta(get_the_ID(), "tdt_subheading1", true) ) { echo '<div class="title">' . get_post_meta(get_the_ID(), "tdt_subheading1", true) . '</div>'; } ?>
		
		 <?php
        if( is_singular( 'tdt_portfolio' ) && get_post_meta(get_the_ID(), "tdt_header_breadcrumb_show_categories", true) == 'yes' ) {
        ?>
            <div class="tdt-portfolio-category">
                <?php the_terms(get_the_ID(), 'project_category', '<em>', ' + ', '</em>'); ?>
            </div><?php
        } else {
        ?>
		
		<div class="title">
            <?php echo tdt_get_custom_title(); ?>
        </div>
		  <?php
        }
 	<?php
        if( is_singular( 'tdt_portfolio' ) && get_post_meta(get_the_ID(), "tdt_header_breadcrumb_show_categories", true) == 'yes' ) {
        ?>
            <div class="tdt-portfolio-category">
                <?php the_terms(get_the_ID(), 'project_category', '<em>', ' + ', '</em>'); ?>
            </div>
        ?>
		
                <?php
        } else {
        ?>
        <?php if ( is_singular() && get_post_meta(get_the_ID(), "tdt_subheading", true) ) { echo '<div class="subtitle"><em>' . get_post_meta(get_the_ID(), "tdt_subheading", true) . '</em></div>'; } ?>
        <?php
        }
        ?>
    </div>
	
	
	<div class="decoration-top ">	
						
			</div>	
	
</div>
<?php } ?>