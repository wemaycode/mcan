<?php 
/**
 * File Type: Sermon Templates Class
 */
 

if ( !class_exists('SermonTemplates') ) {
	
	class SermonTemplates
	{
		
		function __construct()
		{
			// Constructor Code here..
		}
	
		//======================================================================
		// Sermon Listing View
		//======================================================================
		public function cs_sermon_list_view() {
		
			global $post;
			$width = '372';
			$height = '279';
			
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$cs_sermons = get_post_meta(get_the_id(), "sermons", true);
			if ( $cs_sermons <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($cs_sermons);
				$cs_post_social_sharing 			= isset($cs_xmlObject->post_social_sharing)?$cs_xmlObject->post_social_sharing:'';
				$sermon_audio_url ='';			
				$sermon_audio_download_link = isset($cs_xmlObject->sermon_audio_download_link)?$cs_xmlObject->sermon_audio_download_link:'';;
				$sermon_notes_link			= isset($cs_xmlObject->sermon_notes_link)?$cs_xmlObject->sermon_notes_link:'';
				$post_social_sharing_text 			= isset($cs_xmlObject->post_social_sharing_text)?$cs_xmlObject->post_social_sharing_text:'';
				$sermon_speaker			= isset($cs_xmlObject->sermon_speaker)?$cs_xmlObject->sermon_speaker:'';

				$counter_sermons = $post->ID;
				if( isset($cs_xmlObject->sermons) && count($cs_xmlObject->sermons)>0 ){
					foreach ( $cs_xmlObject->sermons as $transct ){						
							$sermon_title = $transct->sermon_title;
							$sermon_audio_url = $transct->sermon_file_url;
							$counter_sermons++;
							break;
					}
				}
			}else{
					$sermon_audio_url = $sermon_audio_download_link = $sermon_notes_link = $cs_post_social_sharing = $sermon_speaker='';
			}
				
			?>
			<div class="col-md-12">
				<article class="cs-sermons sermon-list clearfix">
					<?php if($thumbnail <> '') { ?>
                        <figure><a href="<?php the_permalink(); ?>"><img alt="" src="<?php echo esc_url($thumbnail); ?>"></a></figure>
					<?php } ?>
                        <section class="clearfix">
                          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                          <ul class="post-option">
						  <?php if($sermon_speaker <> ''){ ?>
                            <li><i class="fa fa-user"></i><?php echo esc_attr($sermon_speaker); ?></li>
						  <?php } ?>
                            <li>
                              <time datetime="<?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?>"><i class="fa fa-building-o"></i><?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?></time>
                            </li>
							<?php $categories_list = get_the_term_list ( get_the_id(), 'sermon-category', 'Series: ' , ', ', '' );
								if ( $categories_list ){
							?>
									<li> <i class="fa fa-book"></i>
								<?php 
										printf( __( '%1$s', 'Awaken'),$categories_list );
								?>
									</li>
							  <?php } ?>
                          </ul>
                          <ul class="post-links">
						  <?php if($sermon_audio_url <> ''){ ?>
                            <li>
                              <button class="btn-style1 showdiv"><i class="fa fa-play"></i><?php _e('Play Now','Awaken');?></button>
                            </li>
							<?php 
								}
							if($sermon_audio_download_link<>''){ ?>
									<li><a href="<?php echo esc_url($sermon_audio_download_link); ?>" class="btn-style2"><i class="fa fa-microphone"></i><?php _e('Download Audio','Awaken');?></a></li>
							<?php } 
							 if($sermon_notes_link <> ''){ 
							?>
									<li><a href="<?php echo esc_url($sermon_notes_link) ?>" class="btn-style2"><i class="fa fa-file-pdf-o"></i><?php _e('Notes','Awaken');?></a></li>
							<?php } 
							
							if ($cs_post_social_sharing == "on"){
								cs_addthis_script_init_method();
							?>
									<li><a href="#" class="btn-style2 btnshare addthis_button_compact"><i class="fa fa-share-alt"></i><?php echo esc_attr($post_social_sharing_text); ?></a></li>
							<?php } ?>
                          </ul>
                        </section>
						<?php if($sermon_audio_url <> ''){ ?>
							<audio type="audio/mp3" class="hidediv" width="100%" style="display: none;">
								<source src="<?php echo esc_attr($sermon_audio_url); ?>" >
							</audio>
						<?php } ?>
						</article>
				</div>

		<?php 
		}
		//======================================================================
		// Sermon Grid View
		//======================================================================
		public function cs_sermon_grid_view($cs_sermon_grid_layout='col-md-4') {
		
			global $post;
			$width = '370';
			$height = '208';
		
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "sermons", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$sermon_audio_url 			= '';
				$sermon_audio_download_link = isset($cs_xmlObject->sermon_audio_download_link)?$cs_xmlObject->sermon_audio_download_link:'';;
				$sermon_notes_link			= isset($cs_xmlObject->sermon_notes_link)?$cs_xmlObject->sermon_notes_link:'';
				$cs_post_social_sharing 			= isset($cs_xmlObject->post_social_sharing)?$cs_xmlObject->post_social_sharing:'';
				$sermon_speaker			= isset($cs_xmlObject->sermon_speaker)?$cs_xmlObject->sermon_speaker:'';
				$counter_sermons = 0;
				if(isset($cs_xmlObject->sermons) && count($cs_xmlObject->sermons)){
					foreach ( $cs_xmlObject->sermons as $transct ){
							$sermon_title = $transct->sermon_title;
							$sermon_audio_url = $transct->sermon_file_url;
							$counter_sermons++;
							break;
					}
				}
			}else{
					$sermon_audio_url = $sermon_audio_download_link = $sermon_notes_link = $cs_post_social_sharing = $sermon_speaker='';
			}
		?>
				<div class="<?php echo esc_attr($cs_sermon_grid_layout); ?>">
				
					<article class="cs-sermons sermon-grid clearfix">
                        <?php if($thumbnail <> '') {?>
                        <figure><a href="<?php the_permalink(); ?>"><img alt="" src="<?php echo esc_url($thumbnail); ?>"></a></figure>
						<?php } ?>
						
                        <section>
                          <h2><a href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(),0,30);echo (strlen(get_the_title())>30)?'...':''; ?></a></h2>
                          <ul class="post-option">
							<?php if( $sermon_speaker <> ''){ ?>
								<li><i class="fa fa-user"></i><?php echo esc_attr($sermon_speaker); ?></li>
							<?php } ?>
                            <li>
                              <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><i class="fa fa-building-o"></i><?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?></time>
                            </li>
                          </ul>
                          <ul class="post-links">
							<?php if($sermon_audio_url <> ''){ ?>
									<li>
									<audio class="cs-audio-skin">
										<source src="<?php echo esc_url($sermon_audio_url); ?>" >
									</audio>
									</li>
							<?php 
								}
							if($sermon_audio_download_link <> ''){ ?>
									<li><a href="<?php echo esc_url($sermon_audio_download_link); ?>" class="btn-style2"><i class="fa fa-download"></i></a></li>
							<?php } 
								if($sermon_notes_link <> ''){ 
							?>
									<li><a href="<?php echo esc_url($sermon_notes_link); ?>" class="btn-style2"><i class="fa fa-file-pdf-o"></i></a></li>
							<?php }
							if ($cs_post_social_sharing == "on"){
								cs_addthis_script_init_method();
							?>
								<li><a href="#" class="btn-style2 btnshare addthis_button_compact"><i class="fa fa-share-alt"></i></a></li>
							<?php } ?>
                          </ul>
                        </section>
						
					</article>
			
				</div>
				
			
			<?php
		
			}
			
		//======================================================================
		// Sermon Less View
		//======================================================================
		public function cs_sermon_less_view() {
		
			global $post;
			$width = '370';
			$height = '208';
			
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "sermons", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$sermon_audio_url 			= isset($cs_xmlObject->sermon_audio_url)?$cs_xmlObject->sermon_audio_url:'';
				$sermon_audio_download_link = isset($cs_xmlObject->sermon_audio_download_link)?$cs_xmlObject->sermon_audio_download_link:'';;
				$sermon_notes_link			= isset($cs_xmlObject->sermon_notes_link)?$cs_xmlObject->sermon_notes_link:'';
				
			}else{
				$sermon_audio_url = $sermon_audio_download_link = $sermon_notes_link ='';
			}
			?>
					<div class="col-md-4">
                      <article class="cs-sermons sermon-less clearfix">
                        <?php if($thumbnail <> '') {?>
							<figure><a href="<?php the_permalink(); ?>"><img alt="sermon-less" src="<?php echo esc_url($thumbnail); ?>"></a></figure>
						<?php } ?>
                        <section>
                          <h2><a href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(),0,30);echo (strlen(get_the_title())>30)?'...':''; ?></a></h2>
                          <ul class="post-option">
                            <li>
                              <time datetime="<?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?>"><i class="fa fa-building-o"></i><?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?></time>
                            </li>
                          </ul>
                        </section>
                      </article>
                    </div>
			<?php
			}
			
		//======================================================================
		// Sermon Less View
		//======================================================================
		public function cs_latest_sermo_view() {
		
			global $post,$latest_sermon_section_title,$cs_sermon_text_color;
			$width = '150';
			$height = '150';
			
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "sermons", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$sermon_speaker = isset($cs_xmlObject->sermon_speaker) ? $cs_xmlObject->sermon_speaker:'';
			}else{
				 $sermon_speaker ='';
			}
			?>
            <article class="cs-sermons single-sermone">
              <div class="srtitle"><h5 style="color:<?php echo cs_allow_special_char($cs_sermon_text_color); ?> !important;"><i class="fa fa-book"></i><?php echo esc_attr($latest_sermon_section_title); ?></h5></div>
              <div class="sr-info-sec">
              <?php if($thumbnail <> ''){ ?>
               	 <figure><a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($thumbnail); ?>" alt="latest-sermon" /></a></figure>
              <?php } ?>
                <div class="sep-info">
                  <h5><a  style="color:<?php echo cs_allow_special_char($cs_sermon_text_color); ?> !important;" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                  <ul class="post-option">
                    <li  style="color:<?php echo cs_allow_special_char($cs_sermon_text_color); ?> !important;"><i class="fa fa-calendar"></i> <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?></time></li>
                    <?php if($sermon_speaker<>'') { ?>
                    		<li><i class="fa fa-user"></i> <a  style="color:<?php echo cs_allow_special_char($cs_sermon_text_color); ?> !important;" href="#"><?php echo esc_attr($sermon_speaker); ?></a></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <a href="<?php the_permalink(); ?>" class="btn-style1 cs-bg-color"><i class="fa fa-headphones"></i><?php _e('Listen Now','Awaken'); ?></a>
            </article>
            <?php
		
		}

	}
}