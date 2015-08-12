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
				
				// Get main Wordpress user data
				$results = get_users( $args );
				
				// Sort
				//echo $blogusers[0]->display_name;
				
				// Array of WP_User objects.
				foreach ( $results as $result ) {
					$userdata = get_userdata($result->ID);
					$user = get_user_meta($result->ID);
									
					//$usermeta = get_user_meta($userid);
					
					// create custom array w/ user info, using nickname (sort) field as ID
					$infousers[$user['nickname'][0]] = array(
						'user_order' => $user['nickname'],
						'user_nicename' => $userdata->user_nicename,
						'user_fullname' => $user['first_name'][0] . " " . $user['last_name'][0],
						'user_title' => $user['tagline'][0],
						'user_bio' => $user['description'][0],
						'user_avatar' => $user['user_avatar_display'][0]
					);
					
					
/*					
					print "<pre>";
					print_r($userdata);
					print "</pre>";
					
					print "<pre>";
					print_r($user);
					print "</pre>";
	*/			
				}				
				
				// Sort by nickname/sort field
				sort($infousers);
					
				// loop through sorted array
				foreach ( $infousers as $infouser ) {
					
					//echo $infouser['user_fullname'] . "<br>";	
					
					
					echo '<div class="col-md-3">';
					
						echo '<a class="fancybox" rel="group" href="#' . $infouser["user_nicename"] . '">';
							echo "<img src='" . $infouser["user_avatar"] . "' /><br/>";
							echo "<div class='staff-name'>" . $infouser["user_fullname"] . "</div>";
							echo "<div class='staff-title'>" . $infouser["user_title"] . "</div>";
						echo '</a><br/>';
						
						echo '<div id="' . $infouser["user_nicename"] . '" style="display:none;">';					
							echo "<img src='" . $infouser["user_avatar"] . "' />";
							echo "<span class='staff-name'>" . $infouser["user_fullname"] . "</span>";
							echo "<span class='staff-title'> - " . $infouser["user_title"] . "</span>";
							echo '<p>' . $infouser['user_bio'] . '</p>';
						echo '</div>';
						
					echo '</div>';
					
				}
				
				/*
					print "<pre>";
					print_r($infousers);
					print "</pre>";
					
				*/
				
				?>
				
				
                <!--</div>-->
			</div>
       </div>
     </div>
 </section>
 <?php
get_footer(); ?>