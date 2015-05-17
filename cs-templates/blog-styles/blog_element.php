<?php
/**
 * File Type: Blog Page Builder Element
 */


//======================================================================
// Blog html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_blog' ) ) {
	function cs_pb_blog($die = 0){
		global $cs_node, $post;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$counter = $_POST['counter'];
		$cs_counter = $_POST['counter'];
		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$PREFIX = 'cs_blog';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('cs_blog_section_title'=>'','cs_blog_view'=>'','cs_blog_cat'=>'','cs_blog_orderby'=>'DESC','orderby'=>'ID','cs_blog_description'=>'yes','cs_blog_filterable'=>'','cs_blog_excerpt'=>'255','cs_blog_num_post'=>'10','blog_pagination'=>'','cs_blog_class' => '','cs_blog_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			$blog_element_size = '50';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_blog';
			$coloumn_class = 'column_'.$blog_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
    <div id="<?php echo esc_attr( $name.$cs_counter );?>_del" class="column  parentdelete <?php echo esc_attr( $coloumn_class );?> <?php echo esc_attr( $shortcode_view );?>" item="blog" data="<?php echo element_size_data_array_index($blog_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$blog_element_size);?>
      <div class="cs-wrapp-class-<?php echo intval( $cs_counter )?> <?php echo esc_attr( $shortcode_element );?>" id="<?php echo esc_attr( $name.$cs_counter )?>" data-shortcode-template="[cs_blog {{attributes}}]"  style="display: none;">
        <div class="cs-heading-area">
          <h5><?php _e('Edit Blog Options','Awaken');?></h5>
          <a href="javascript:removeoverlay('<?php echo esc_js( $name.$cs_counter );?>','<?php echo esc_js( $filter_element );?>')" class="cs-btnclose"><i class="fa fa-times"></i></a> </div>
        <div class="cs-pbwp-content">
          <div class="cs-wrapp-clone cs-shortcode-wrapp">
            <?php
             if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Section Title','Awaken');?></label></li>
                <li class="to-field">
                    <input  name="cs_blog_section_title[]" type="text"  value="<?php echo esc_attr( $cs_blog_section_title )?>"   />
                </li>                  
             </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Choose Category','Awaken');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
                    <select name="cs_blog_cat[]" class="dropdown">
                      <option value="0"><?php _e('Select Category','Awaken');?></option>
                      <?php show_all_cats('', '', $cs_blog_cat, "category");?>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select category to show posts. If you dont select category it will display all posts.','Awaken');?></p>
                </div>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Blog Design Views','Awaken');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
				    <select name="cs_blog_view[]" class="dropdown">
                      <option value="blog-small" <?php if($cs_blog_view == 'blog-small'){echo 'selected="selected"';}?>><?php _e('Blog Small','Awaken');?></option>
                      <option value="blog-medium" <?php if($cs_blog_view == 'blog-medium'){echo 'selected="selected"';}?>><?php _e('Blog Medium','Awaken');?></option>
                      <option value="blog-lrg" <?php if($cs_blog_view == 'blog-lrg'){echo 'selected="selected"';}?>><?php _e('Blog Large','Awaken');?></option>
                      <option value="blog-classic" <?php if($cs_blog_view == 'blog-classic'){echo 'selected="selected"';}?>><?php _e('Blog Classic','Awaken');?></option>
                      <option value="blog-timeline" <?php if($cs_blog_view == 'blog-timeline'){echo 'selected="selected"';}?>><?php _e('Blog timeline','Awaken');?></option>
                      <option value="blog-3-column" <?php if($cs_blog_view == 'blog-3-column'){echo 'selected="selected"';}?>><?php _e('Blog 3 Column','Awaken');?></option>
                      <option value="blog-grid" <?php if($cs_blog_view == 'blog-grid'){echo 'selected="selected"';}?>><?php _e('Blog Grid','Awaken');?></option>
                      <option value="blog-clean" <?php if($cs_blog_view == 'blog-clean'){echo 'selected="selected"';}?>><?php _e('Blog Clean','Awaken');?></option>
                      <option value="blog-box" <?php if($cs_blog_view == 'blog-box'){echo 'selected="selected"';}?>><?php _e('Blog Box','Awaken');?></option>
                      <option value="blog-elite" <?php if($cs_blog_view == 'blog-elite'){echo 'selected="selected"';}?>><?php _e('Blog Elite','Awaken');?></option>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select category to show posts. If you dont select category it will display all posts','Awaken');?></p>
                </div>
              </li>
            </ul>
            <div id="Blog-listing<?php echo intval($cs_counter);?>" >
              <ul class="form-elements">
                <li class="to-label">
                  <label><?php _e('Post Order','Awaken');?></label>
                </li>
                <li class="to-field">
                  <div class="input-sec">
                    <div class="select-style">
                      <select name="cs_blog_orderby[]" class="dropdown" >
                        <option <?php if($cs_blog_orderby=="ASC")echo "selected";?> value="ASC"><?php _e('Asc','Awaken');?></option>
                        <option <?php if($cs_blog_orderby=="DESC")echo "selected";?> value="DESC"><?php _e('DESC','Awaken');?></option>
                      </select>
                    </div>
                  </div>
                </li>
              </ul>
              <ul class="form-elements">
                <li class="to-label">
                  <label><?php _e('Post Description','Awaken');?></label>
                </li>
                <li class="to-field">
                  <div class="input-sec">
                    <div class="select-style">
                      <select name="cs_blog_description[]" class="dropdown" >
                        <option <?php if($cs_blog_description=="yes")echo "selected";?> value="yes"><?php _e('Yes','Awaken');?></option>
                        <option <?php if($cs_blog_description=="no")echo "selected";?> value="no"><?php _e('No','Awaken');?></option>
                      </select>
                    </div>
                  </div>
                </li>
              </ul>
              <ul class="form-elements">
                  <li class="to-label">
                    <label> <?php _e('Filterable','Awaken'); ?> </label>
                  </li>
                  <li class="to-field">
                    <div class="input-sec">
                      <div class="select-style">
                        <select name="cs_blog_filterable[]" class="dropdown">
                          <option value="yes" <?php if($cs_blog_filterable=="yes")echo "selected";?>><?php _e('Yes','Awaken'); ?></option>
                          <option value="no" <?php if($cs_blog_filterable=="no")echo "selected";?> ><?php _e('No','Awaken'); ?></option>
                        </select>
                      </div>
                    </div>
                  </li>
              </ul>
              <ul class="form-elements">
                <li class="to-label">
                  <label><?php _e('Length of Excerpt','Awaken');?></label>
                </li>
                <li class="to-field">
                  <div class="input-sec">
                    <input type="text" name="cs_blog_excerpt[]" class="txtfield" value="<?php echo esc_attr( $cs_blog_excerpt );?>" />
                  </div>
                  <div class="left-info">
                    <p><?php _e('Enter number of character for short description text','Awaken');?></p>
                  </div>
                </li>
              </ul>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('No. of Post Per Page','Awaken');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <input type="text" name="cs_blog_num_post[]" class="txtfield" value="<?php echo esc_attr( $cs_blog_num_post ); ?>" />
                </div>
                <div class="left-info">
                  <p><?php _e('To display all the records, leave this field blank','Awaken');?></p>
                </div>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Pagination','Awaken');?></label>
              </li>
              <li class="to-field select-style">
                <select name="blog_pagination[]" class="dropdown">
                  <option <?php if($blog_pagination=="Show Pagination")echo "selected";?> ><?php _e('Show Pagination','Awaken');?></option>
                  <option <?php if($blog_pagination=="Single Page")echo "selected";?> ><?php _e('Single Page','Awaken');?></option>
                </select>
              </li>
            </ul>
            <?php 
                if ( function_exists( 'cs_shortcode_custom_classes' ) ) {
                    cs_shortcode_custom_dynamic_classes($cs_blog_class,$cs_blog_animation,'','cs_blog');
                }
            ?>
            <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
            <ul class="form-elements insert-bg">
              <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js( str_replace('cs_pb_','',$name) );?>','<?php echo esc_js( $name.$cs_counter )?>','<?php echo esc_js( $filter_element );?>')" ><?php _e('Insert','Awaken');?></a> </li>
            </ul>
            <div id="results-shortocde"></div>
            <?php } else {?>
            <ul class="form-elements">
              <li class="to-label"></li>
              <li class="to-field">
                <input type="hidden" name="cs_orderby[]" value="blog" />
                <input type="button" value="Save" style="margin-right:10px;" onclick="javascript:_removerlay(jQuery(this))" />
              </li>
            </ul>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_cs_pb_blog', 'cs_pb_blog');
}