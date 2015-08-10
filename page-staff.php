<!-- page-blank.php -->
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
							wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Awaken' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
                        } // end while
                    } // end if
                ?>
				
				<?php
				$blogusers = get_users();
				// Array of WP_User objects.
				foreach ( $blogusers as $user ) {
					echo '<span>' . esc_html( $user->user_email ) . '</span>';
				}
				?>
				
				
                <!--</div>-->
			</div>
       </div>
     </div>
 </section>
 <?php
get_footer(); ?>