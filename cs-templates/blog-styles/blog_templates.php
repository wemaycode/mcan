<?php 
/**
 * File Type: Blog Templates Class
 */
 

if ( !class_exists('BlogTemplates') ) {
	
	class BlogTemplates
	{
		
		function __construct()
		{
			// Constructor Code here..
		}
	
		//======================================================================
		// Blog Small View
		//======================================================================
		public function cs_small_view( $description,$excerpt ) {
			global $post;
			$width = '372';
			$height = '279';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = $cs_xmlObject->post_thumb_view;	
			}
				
			?>
			
			<div class="col-md-12">
			  <article class="cs-blog blog-small clearfix has_shapes">
				<?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure>
								<?php cs_featured(); ?>
                                <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
								<figcaption><a href="<?php echo the_permalink();?>"><i class="fa fa-align-justify"></i></a></figcaption>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
							cs_featured();
							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
				<section>
				  <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n('M',strtotime(get_the_date()));?><small><?php echo date_i18n('j',strtotime(get_the_date()));?></small> </time>
				  <div class="title">
					<h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
					<ul class="post-option clearfix">
					  <li><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author();?></a> </li>
					</ul>
					<!--title--> 
				  </div>
				  <?php if ($description == 'yes') {?><p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
				  <a href="<?php echo the_permalink();?>" class="continue-reading"><i class="fa fa-angle-right"></i><?php _e('Continue Reading','Awaken');?></a>
				  <ul class="post-option-btm clearfix">
					<li><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i><?php echo comments_number(__('0', 'Awaken'), __('1', 'Awaken'), __('%', 'Awaken') );?> </a></li>
					<?php //if ( $post_social_sharing == 'on' ) { ?>
						<?php cs_addthis_script_init_method();?>
                    	<li><a class="btnshare addthis_button_compact"><i class="fa fa-share-alt"></i><?php _e('Share','Awaken');?></a></li>
                    <?php //}?>
				  </ul>
				</section>
			  </article>
			</div>
			
		<?php 
		}
		
		
		//======================================================================
		// Blog Medium View
		//======================================================================
		public function cs_medium_view( $description,$excerpt ) { 
			global $post;
			$width = '372';
			$height = '279';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = $cs_xmlObject->post_thumb_view;	
			}
		?>
		
            <div class="col-md-12">
              <article class="cs-blog blog-medium clearfix has_shapes">
                <?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure>
								<?php cs_featured(); ?>
                                <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
								<figcaption><a href="<?php echo the_permalink();?>"><i class="fa fa-align-justify"></i></a></figcaption>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
							cs_featured();
							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
                <section>
                  <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n('M',strtotime(get_the_date()));?><small><?php echo date_i18n('j',strtotime(get_the_date()));?></small> </time>
                  <div class="title">
                    <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                    <ul class="post-option clearfix">
					  <li><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author();?></a> </li>
					</ul>
                    <!--title--> 
                  </div>
                  <?php if ($description == 'yes') {?><p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
                  <a href="<?php echo the_permalink();?>" class="continue-reading"><i class="fa fa-angle-right"></i><?php _e('Continue Reading','Awaken');?></a>
				  <ul class="post-option-btm clearfix">
					<li><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i><?php echo comments_number(__('0', 'Awaken'), __('1', 'Awaken'), __('%', 'Awaken') );?> </a></li>
                    <?php //if ( $post_social_sharing == 'on' ) { ?>
						<?php cs_addthis_script_init_method();?>
                    	<li><a class="btnshare addthis_button_compact"><i class="fa fa-share-alt"></i><?php _e('Share','Awaken');?></a></li>
                    <?php //}?>
                  </ul>
                </section>
              </article>
            </div>	
		<?php
        }
		
		
		//======================================================================
		// Blog Large View
		//======================================================================
		public function cs_large_view( $description,$excerpt ) {
			global $post;
			$width = '844';
			$height = '475';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = $cs_xmlObject->post_thumb_view;	
			}
			?>
			
			<div class="col-md-12">
			  <article class="cs-blog blog-lrg clearfix has_shapes">
                <?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure>
								<?php cs_featured(); ?>
                                <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
								<figcaption><a href="<?php echo the_permalink();?>"><i class="fa fa-align-justify"></i></a></figcaption>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
							cs_featured();
							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
                <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n('M',strtotime(get_the_date()));?><small><?php echo date_i18n('j',strtotime(get_the_date()));?></small> </time>
                <section>
                 <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                  <ul class="post-option clearfix">
                 	 <li><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author();?></a> </li>
                  </ul>
                  <?php if ($description == 'yes') {?><p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
                  <a href="<?php echo the_permalink();?>" class="continue-reading"><i class="fa fa-angle-right"></i><?php _e('Continue Reading','Awaken');?></a>
				  <ul class="post-option-btm clearfix">
					<li><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i><?php echo comments_number(__('0', 'Awaken'), __('1', 'Awaken'), __('%', 'Awaken') );?></a></li>
                    <?php //if ( $post_social_sharing == 'on' ) { ?>
						<?php cs_addthis_script_init_method();?>
                    	<li><a class="btnshare addthis_button_compact"><i class="fa fa-share-alt"></i><?php _e('Share','Awaken');?></a></li>
                    <?php //}?>
                  </ul>
                </section>
              </article>
			</div>
		
		<?php 
		
		}
		
		
		//======================================================================
		// Blog Classic View
		//======================================================================
		public function cs_classic_view( $description,$excerpt ) {
			global $post;
			$width = '840';
			$height = '333';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = $cs_xmlObject->post_thumb_view;	
			}
			?>
			<?php 
				$postCats = get_the_category();
				foreach($postCats as $postCat){
					if($postCat->description != null)
						$catColorStyle = "border-left: 10px solid " . $postCat->description;
					}
			?>
			<div class="col-md-12">
			  <article class="cs-blog cs-blog-classic clearfix has_shapes"> 
				<div class="blog-title-wrapper" style="<?php echo $catColorStyle ?>">
					
					<h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
					<ul class="post-option clearfix">
					  <li> <i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author();?></a> </li>
					  <li> <i class="fa fa-calendar-o"></i><?php echo date_i18n(get_option( 'date_format' ),strtotime(get_the_date()));?></li>
					  <li> <i class="fa fa-folder-o"></i> 
						<?php 
						if ( isset($cs_blog_cat) && $cs_blog_cat !='' && $cs_blog_cat !='0'){ 
							echo '<a href="'.site_url().'?cat='.$row_cat->term_id.'">'.$row_cat->name.'</a>';
						 } else {
							 /* Get All Tags */
	 
							  $categories_list = get_the_term_list ( get_the_id(), 'category', '' , ', ', '' );
							  if ( $categories_list ){
								printf( __( '%1$s', 'Awaken'),$categories_list );
							  } 
							 // End if Tags 
						 }
						?>
					  </li>
					  <!--
					  <li> <i class="fa fa-comment-o"></i> <a href="<?php comments_link(); ?>"><?php echo comments_number(__('Comments 0', 'Awaken'), __('Comments 1', 'Awaken'), __('Comments %', 'Awaken') );?></a> </li>
					  -->
					</ul>
				</div>
				
				<?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure>
                              	<?php cs_featured(); ?>
                                <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
								<figcaption><a href="<?php echo the_permalink();?>"><i class="fa fa-align-justify"></i></a></figcaption>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
							cs_featured();
							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
				<section>
				  <?php if ($description == 'yes') {?><p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
				  <div class="clearfix"> 
                  	  <a href="<?php echo the_permalink();?>" class="continue-reading">
						<?php _e('Continue Reading','Awaken');?>
						>>
					</a>
                      <ul class="post-option-btm clearfix">
                        <!--<li><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i><?php echo comments_number(__('0', 'Awaken'), __('1', 'Awaken'), __('%', 'Awaken') );?></a></li>
						-->
                        <?php //if ( $post_social_sharing == 'on' ) { ?>
                            <?php cs_addthis_script_init_method();?>
                            <li><a class="btnshare addthis_button_compact"><i class="fa fa-share-alt"></i><?php _e('Share','Awaken');?></a></li>
                        <?php //}?>
                      </ul>
				  </div>
				</section>
			  </article>
			</div>
			
		<?php 
		
		}
		
		
		//======================================================================
		// Blog Timeline View
		//======================================================================
		public function cs_timeline_view( $description,$excerpt,$last_child ='') {
			global $post;
			$width = '372';
			$height = '279';
			$title_limit = 1000;
			$imageFrame	= '';
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = $cs_xmlObject->post_thumb_view;	
			}
						
			if ( isset( $thumbnail ) && $thumbnail =='' ) {
				$imageFrame	= ' no-image';
			}
			?>
            
			<div class="col-md-12">
              <article class="cs-blog blog-timeline clearfix <?php echo esc_attr( $imageFrame );?> <?php echo cs_allow_special_char($last_child) ?>">
                <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n('M',strtotime(get_the_date()));?><small><?php echo date_i18n('j',strtotime(get_the_date()));?></small> </time>
                <?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure>
                              	<?php cs_featured(); ?>
                                <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
								<figcaption><a href="<?php echo the_permalink();?>"><i class="fa fa-align-justify"></i></a></figcaption>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
							cs_featured();
							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
                <section class="clearfix">
                  <div class="title">
                    <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
					<ul class="post-option clearfix">
					  <li><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author();?></a> </li>
					</ul>
                    <!--title--> 
                  </div>
                  <?php if ($description == 'yes') {?><p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
				  <a href="<?php echo the_permalink();?>" class="continue-reading"><i class="fa fa-angle-right"></i><?php _e('Continue Reading','Awaken');?></a>
				  <ul class="post-option-btm clearfix">
					<li><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i><?php echo comments_number(__('0', 'Awaken'), __('1', 'Awaken'), __('%', 'Awaken') );?> </a></li>
					<?php //if ( $post_social_sharing == 'on' ) { ?>
						<?php cs_addthis_script_init_method();?>
                    	<li><a class="btnshare addthis_button_compact"><i class="fa fa-share-alt"></i><?php _e('Share','Awaken');?></a></li>
                    <?php //}?>
				  </ul>
                </section>
              </article>
            </div>
		<?php
        }
		
		//======================================================================
		// Blog Masonry View ( Blog 3 Column ) 
		//======================================================================
		public function cs_mesnory_view( $description,$excerpt ) {
			global $post;
			$width = '370';
			$height = '208';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = $cs_xmlObject->post_thumb_view;	
			}
		?>
		   <div class="col-md-4">
            <article class="cs-blog cs-blog-grid clearfix has_shapes">
               <?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure><?php cs_featured(); ?><a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
								<figcaption><a href="<?php echo the_permalink();?>"><i class="fa fa-align-justify"></i></a></figcaption>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
							cs_featured();
							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
              <section>
                <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n('M',strtotime(get_the_date()));?><small><?php echo date_i18n('j',strtotime(get_the_date()));?></small> </time>
                <div class="title clearfix">
                  <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                   <ul class="post-option clearfix">
                      <li><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author();?></a> </li>
                   </ul>
                  <!--title--> 
                </div>
                <?php if ($description == 'yes') {?><p><?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
                  <a href="<?php echo the_permalink();?>" class="continue-reading"><i class="fa fa-angle-right"></i><?php _e('Continue Reading','Awaken');?></a>
                  <ul class="post-option-btm clearfix">
					<!-- COMMENT OUT -->
                    <!--<li><a href="<?php //comments_link(); ?>"><i class="fa fa-comment-o"></i><?php //echo comments_number(__('0', 'Awaken'), __('1', 'Awaken'), __('%', 'Awaken') );?> </a></li>-->
                    <?php //if ( $post_social_sharing == 'on' ) { ?>
                        <?php cs_addthis_script_init_method();?>
                        <li><a class="btnshare addthis_button_compact"><!--<i class="fa fa-share-alt"></i>--><?php _e('Share','Awaken');?></a></li>
                    <?php //}?>
                  </ul>
              </section>
              <!--blog-grid--> 
            </article>
           </div>
        <?php }
		//======================================================================
		// Blog Clean View
		//======================================================================
		public function cs_clean_view( $description,$excerpt ) {
			global $post;
			$width = '300';
			$height = '300';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = $cs_xmlObject->post_thumb_view;	
			}
			?>
		<div class="col-md-12">
          <article class="cs-blog blog-clean clearfix">
            <?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure>
                              <?php cs_featured(); ?>
                              <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
                              </figure>
							</div>
				<?php }
                  } else if ($post_thumb_view == 'Slider') {
                        	echo '<div class="cs-media"><figure>';
							cs_featured();
							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
                  } 
             ?>
            <section class="clearfix">
              <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
              <?php if ($description == 'yes') {?><p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
              <ul class="post-option">
                <li><i class="fa fa-calendar-o"></i><?php echo date_i18n(get_option( 'date_format' ),strtotime(get_the_date()));?></li>
                <li><i class="fa fa-folder-o"></i><?php 
                    if ( isset($cs_blog_cat) && $cs_blog_cat !='' && $cs_blog_cat !='0'){ 
                        echo '<a href="'.site_url().'?cat='.$row_cat->term_id.'">'.$row_cat->name.'</a>';
                     } else {
                         /* Get All Tags */
                          $categories_list = get_the_term_list ( get_the_id(), 'category', '' , ', ', '' );
                          if ( $categories_list ){
                            printf( __( '%1$s', 'Awaken'),$categories_list );
                          } 
                         // End if Tags 
                     }
					?>
                </li>
              </ul>
            </section>
          </article>
        </div>
		
		<?php
        }
		
		
		//======================================================================
		// Blog Grid View
		//======================================================================
		public function cs_grid_view( $description,$excerpt ,$cs_blog_grid_layout='col-md-3') {
			global $post;
			$width = '370';
			$height = '208';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = $cs_xmlObject->post_thumb_view;	
			}
		?>
		   <div class="<?php echo cs_allow_special_char($cs_blog_grid_layout); ?>">
            <article class="cs-blog cs-blog-grid clearfix has_shapes">
               <?php 
			   	if(isset($post_thumb_view) and $post_thumb_view == 'Single Image') {	 
					if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
						<div class="cs-media">
							  <figure><?php cs_featured(); ?><a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
								<figcaption><a href="<?php echo the_permalink();?>"><i class="fa fa-align-justify"></i></a></figcaption>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
							cs_featured();
							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
              <section>
                <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n('M',strtotime(get_the_date()));?><small><?php echo date_i18n('j',strtotime(get_the_date()));?></small> </time>
                <div class="title clearfix">
                  <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                   <ul class="post-option clearfix">
                      <li><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author();?></a> </li>
                   </ul>
                  <!--title--> 
                </div>
                <?php if ($description == 'yes') {?><p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
                  <a href="<?php echo the_permalink();?>" class="continue-reading"><i class="fa fa-angle-right"></i><?php _e('Continue Reading','Awaken');?></a>
                  <ul class="post-option-btm clearfix">
                    <li><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i><?php echo comments_number(__('0', 'Awaken'), __('1', 'Awaken'), __('%', 'Awaken') );?> </a></li>
                    <?php //if ( $post_social_sharing == 'on' ) { ?>
                        <?php cs_addthis_script_init_method();?>
                        <li><a class="btnshare addthis_button_compact"><i class="fa fa-share-alt"></i><?php _e('Share','Awaken');?></a></li>
                    <?php //}?>
                  </ul>
              </section>
              <!--blog-grid--> 
            </article>
           </div>
              
        <?php }
		
		
		//======================================================================
		// Blog Box View
		//======================================================================
		public function cs_box_view( $description,$excerpt,$cs_box_view ) {
			global $post;
			$width = '300';
			$height = '300';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = $cs_xmlObject->post_thumb_view;	
			}
			?>
			<div class="<?php echo cs_allow_special_char($cs_box_view);?>">
                <article class="cs-blog blog-box clearfix">
                  <div class="category-link">
                    <?php 
                     if ( isset($cs_blog_cat) && $cs_blog_cat !='' && $cs_blog_cat !='0'){ 
                        echo '<a href="'.site_url().'?cat='.$row_cat->term_id.'"><small>'.$row_cat->name.'<small></a>';
                     } else {
                         /* Get All Tags */
                          $categories_list = get_the_term_list ( get_the_id(), 'category', '' , '', '' );
                          if ( $categories_list ){
                            printf( __( '%1$s', 'Awaken'),$categories_list );
                          } 
                         // End if Tags 
                     }?>
                  </div>
                   <?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <?php cs_featured(); ?>
							  <img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>">
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
							cs_featured();
							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
                  <section style="bottom: -95px;">
                    <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                    <ul class="post-option">
                      <li><i class="fa fa-calendar-o"></i><?php echo date_i18n(get_option( 'date_format' ),strtotime(get_the_date()));?></li>
                    </ul>
                    <?php if ($description == 'yes') {?><p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
                  </section>
                </article>
                <!--col-md-3--> 
            </div>
		
		<?php
        }
		
		
		//======================================================================
		// Blog Elite View
		//======================================================================
		public function cs_elite_view( $description,$excerpt ) {
			global $post;
			$width = '840';
			$height = '333';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = $cs_xmlObject->post_thumb_view;	
			}
			?>
			<div class="col-md-12">
            <!-- Article -->
            <article class="cs-blog blog-elite">
                 <?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							  <figure><?php cs_featured(); ?><a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a></figure>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
							cs_featured();
							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
                    <section class="bloginfo">
                        <div class="blog-text">
                            <ul class="post-option">
                                <li>
                                    <?php _e('Posted by','Awaken');?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author();?></a>
                                </li>
                            </ul>
                            <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                            <?php if ($description == 'yes') {?><p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
                            <div class="blog-bottom">
                                <ul class="blog-left">
                                    <li><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i><?php echo comments_number(__('0', 'Awaken'), __('1', 'Awaken'), __('%', 'Awaken') );?> </a></li>
								<?php //if ( $post_social_sharing == 'on' ) { ?>
                                    <?php cs_addthis_script_init_method();?>
                                    <li><a class="btnshare addthis_button_compact"><i class="fa fa-share-alt"></i><?php _e('Share','Awaken');?></a></li>
                                <?php //}?>
                                </ul>
                                <ul class="blog-right">
                                    <li><a href="<?php the_permalink();?>" class="continue-reading"><i class="fa fa-angle-right"></i><?php _e('Continue Reading','Awaken');?></a></li>
                                </ul>
                            </div>
                        </div>
                 </section>
            </article>
            <!-- Article Close -->
         </div>
		
		<?php
        }
	}
}