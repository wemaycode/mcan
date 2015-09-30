<!-- page-resources.php -->
<?php
/*
	Template Name: Resources Grid Page
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
					'category_name' => 'resources' );
				
				$postslist = get_posts( $args );
				
				foreach ( $postslist as $post ) :
				
				  setup_postdata( $post ); ?> 
					
					<div class="col-md-3">
					
						<a class="fancybox" rel="group" href="#<?php echo "post" . $post->ID; ?>">
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
						
						<div id="<?php echo "post" . $post->ID; ?>" style="display:none;">					
							<img src="<?php echo $image[0]; ?>" />
							<span class='grid-title'><?php the_title(); ?></span>
							<p><?php the_content(); ?></p>
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