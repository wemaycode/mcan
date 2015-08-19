<!-- page-currentcampaigns.php -->
<?php
/*
	Template Name: Current Campaigns Grid Page
*/
get_header();

//get_template_part('include/theme-components/cs-header/header','blank');


?>
<section class="page-section">
    <!-- Container -->
    <div class="container">
	
        <!-- Page Content -->
        <div class="row">
            <div class="col-md-12">				
				<?php
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post(); 
                            the_content();
							//wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Awaken' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
                        } // end while
                    } // end if
                ?>
				
			</div>
		</div>
		
		<!-- Grid -->
		<div class="row">
			<?php
				$args = array( 
					'order'=> 'DESC', 
					'orderby' => 'date', 
					'category_name' => 'currentcampaigns' );
				
				$postslist = get_posts( $args );
				
				foreach ( $postslist as $post ) :
				
				  setup_postdata( $post ); ?> 
					
					<div class="col-md-3">
					
						<a href="<?php echo get_permalink(); ?>">
							<?php 
								// check for post thumbnail
								if ( has_post_thumbnail() ) { 
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
							?>
									<div class="grid-thumbnail" style="background-image: url('<?php echo $image[0]; ?>')">
									</div>
							<?php
								} 
							?>
							<br/>
							<div class="grid-title"><?php the_title(); ?></div>
						</a>
						<br/>
						
						<div id="<?php //echo "post" . $post->ID; ?>" style="display:none;">					
							<?php //get_post_thumbnail('medium'); ?>
							<span class='staff-name'><?php //the_title(); ?></span>
							<span class='staff-title'><?php //the_content(); ?></span>
							<p></p>
						</div>
					
					</div>
					
				<?php
				endforeach; 
				wp_reset_postdata();
			?>
				
                <!--</div>-->
			</div>
       </div>
     </div>
 </section>
 <?php
get_footer(); ?>