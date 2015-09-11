<?php
/**
 * The template for displaying Footer
 */
 global $wpdb,$cs_theme_options;
 ?>
        <!-- Main Section End -->
		<!-- footer.php -->
        </div>
        </main>
        <!-- Main Content Section -->
        <div class="clear"></div> 
        <!-- Footer Start -->
        <?php
		$footer_twitter = '';
 		if(isset($cs_theme_options['cs_footer_twitter']) && $cs_theme_options['cs_footer_twitter'] <> '')
        	$footer_twitter = $cs_theme_options['cs_footer_twitter'];
        if(isset($footer_twitter) and $footer_twitter=='on'){
			$tweet_bg_color = (isset($cs_theme_options['cs_footer_tweet_bgcolor']) && $cs_theme_options['cs_footer_tweet_bgcolor'] <> '')? $cs_theme_options['cs_footer_tweet_bgcolor'] :'#1dcaff';
			?>
			<section class="footer-tweets group" style="background:<?php echo cs_allow_special_char($tweet_bg_color);?> !important;">
			  <div class="container">
				<div class="row"><?php cs_footer_twitter(); ?></div>
			  </div>
			</section>
			<?php
        }
        $cs_footer_switch = '';
		if(isset($cs_theme_options['cs_footer_switch']) && $cs_theme_options['cs_footer_switch'] <> '')
			$cs_footer_switch = $cs_theme_options['cs_footer_switch'];
		if(isset($cs_footer_switch) and $cs_footer_switch=='on'){
			echo '<footer class="group">';
			$cs_footer_widget = $cs_theme_options['cs_footer_widget'];
			if(isset($cs_footer_widget) and $cs_footer_widget == 'on'){
				?>
					<div class="container">
						<div class="row">
							<?php 
                            if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-1') ) : endif; 
                            ?>
						</div>
					</div>
 				<!-- Footer End -->
			<?php } ?>
        <!-- Bottom Section -->
        <div class="copyright clearfix">
            <div class="container">
                <section class="footer-mid-sec">
                    <div class="row">
					  <?php
                      $cs_sub_footer_menu = $cs_theme_options['cs_sub_footer_menu'];
					  if( isset($cs_sub_footer_menu) and $cs_sub_footer_menu == 'on' ){
						  ?>
						  <nav class="footer-nav col-lg-12">
							<?php if ( function_exists( 'cs_navigation' ) ) { cs_navigation('footer-menu','','','1'); } ?>
						  </nav>
						  <?php
					  }
                      ?>
                      <aside class="col-md-5">
                        <p>
                          <?php
                          if ( function_exists( 'cs_footer_logo' ) ) { cs_footer_logo(); } 
                            $cs_copy_right = $cs_theme_options['cs_copy_right'];
                          if(isset($cs_copy_right) and $cs_copy_right<>''){ 
                            echo do_shortcode(htmlspecialchars_decode($cs_copy_right)); 
                          } else{
                            echo '&copy;'.gmdate("Y")." ".get_option("blogname")." Wordpress All rights reserved.";  
                          }
                          ?>
                        </p>
                        <!--left-side--> 
                      </aside>
                      <?php 
                      $cs_sub_footer_social_icons = $cs_theme_options['cs_sub_footer_social_icons'];
                      $cs_footer_newsletter = $cs_theme_options['cs_footer_newsletter'];
                      if( ( isset($cs_sub_footer_social_icons) and $cs_sub_footer_social_icons=='on' ) || ( isset($cs_footer_newsletter) and $cs_footer_newsletter=='on' )){
                      ?>
                      <aside class="col-md-7 clearfix">
                      	<?php
						if( $cs_footer_newsletter == 'on' ){
						?>
                        <div class="signup">
                          <?php  if ( function_exists( 'cs_custom_mailchimp' ) ) { echo cs_custom_mailchimp(); }?>
                        </div>
                        <?php 
						}
						if( $cs_sub_footer_social_icons == 'on' ){
							if ( function_exists( 'cs_social_network' ) ) { cs_social_network(); } 
						}
						?>
                        <!--right-side--> 
                      </aside>
                      <?php
                      }
                      ?>
                      <!--row--> 
                    </div>
                    </section>
                </div>
            </div>
        </footer>
        <?php } ?>
    </div>
    <!-- Wrapper End -->
    <?php
  if(isset($cs_theme_options['cs_google_analytics']) and $cs_theme_options['cs_google_analytics']<>''){
	    echo '<script type="text/javascript">
   					'. htmlspecialchars_decode($cs_theme_options['cs_google_analytics']) .'
			  </script>';
  }
  wp_footer();
?>
<!-- End footer.php -->
</body>
</html>