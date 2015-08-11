<!-- page-staff.php -->
<?php
/*
	Template Name: Staff Grid Page
*/
get_header();

//get_template_part('include/theme-components/cs-header/header','blank');


?>
<section class="page-section">
    <!-- Container -->
    <div class="container">
        <!-- Row -->
        <div class="row">
            <!-- Col Md 12 -->
            <div class="col-md-12">
            	 <!--<div class="col-md-12">-->
				<!-- List of Users -->
				<?php
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post(); 
                            the_content();
							//wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Awaken' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
                        } // end while
                    } // end if
                ?>
				
				
				<?php
				$args = array(
					'blog_id'      => $GLOBALS['blog_id'],
					'role'         => '',
					'meta_key'     => '',
					'meta_value'   => '',
					'meta_compare' => '',
					'meta_query'   => array(),
					'date_query'   => array(),        
					'include'      => array(),
					'exclude'      => array(1),
					'orderby'      => 'login',
					'order'        => 'ASC',
					'offset'       => '',
					'search'       => '',
					'number'       => '',
					'count_total'  => false,
					'fields'       => 'all',
					'who'          => ''
				);
				
				$blogusers = get_users( $args );
				// Array of WP_User objects.
				foreach ( $blogusers as $user ) {
					echo '<a class="fancybox" rel="group" href="#' . esc_html( $user->user_login ) . '">';
					echo 	esc_html( $user->user_login );
					echo '</a><br/>';
					echo '<div id="' . esc_html( $user->user_login ) . '" style="display:none;">';
					echo 	get_avatar($user_info->user_email,apply_filters('PixFill_author_bio_avatar_size', 60));
					echo 	'<p>' . $user->description . '</p>';
					echo '</div>';
				}
				?>
				
				
                <!--</div>-->
			</div>
       </div>
     </div>
 </section>
 <?php
get_footer(); ?>