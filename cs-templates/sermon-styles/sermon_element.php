<?php
/**
 * File Type: Sermon Page Builder Element
 */

//======================================================================
// Sermon html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_sermon' ) ) {
	function cs_pb_sermon($die = 0){
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
			$PREFIX = 'cs_sermon';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('cs_sermon_section_title'=>'','cs_sermon_view'=>'','cs_sermon_cat'=>'','cs_sermon_filterable'=>'','cs_sermon_num_post'=>'10','sermon_pagination'=>'','cs_sermon_class' => '','cs_sermon_animation' => '');
			
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			$sermon_element_size = '50';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_sermon';
			$coloumn_class = 'column_'.$sermon_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
    <div id="<?php echo esc_attr($name.$cs_counter)?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="sermon" data="<?php echo element_size_data_array_index($sermon_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$sermon_element_size);?>
      <div class="cs-wrapp-class-<?php echo intval($cs_counter)?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter)?>" data-shortcode-template="[cs_sermon {{attributes}}]"  style="display: none;">
        <div class="cs-heading-area">
          <h5><?php _e('Edit Sermon Options','Awaken');?></h5>
          <a href="javascript:removeoverlay('<?php echo esc_attr($name.$cs_counter)?>','<?php echo esc_attr($filter_element);?>')" class="cs-btnclose"><i class="fa fa-times"></i></a> </div>
        <div class="cs-pbwp-content">
          <div class="cs-wrapp-clone cs-shortcode-wrapp">
            <?php
             if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Section Title','Awaken');?></label></li>
                <li class="to-field">
                    <input  name="cs_sermon_section_title[]" type="text"  value="<?php echo esc_attr($cs_sermon_section_title)?>"   />
                </li>                  
             </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Choose Category','Awaken');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
                    <select name="cs_sermon_cat[]" class="dropdown">
                      <option value="0"><?php _e('-- Select Category --','Awaken');?></option>
                      <?php show_all_cats('', '', $cs_sermon_cat, "sermon-category");?>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select category to show posts. If you dont select category it will display all posts','Awaken');?></p>
                </div>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Sermon Design Views','Awaken');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
				    <select name="cs_sermon_view[]" class="dropdown">
                      <option value="sermon-list" <?php if($cs_sermon_view == 'sermon-list'){echo 'selected="selected"';}?>><?php _e('Sermon Listing','Awaken');?></option>
                      <option value="sermon-grid" <?php if($cs_sermon_view == 'sermon-grid'){echo 'selected="selected"';}?>><?php _e('Sermon Grid','Awaken');?></option>
                      <option value="sermon-less" <?php if($cs_sermon_view == 'sermon-less'){echo 'selected="selected"';}?>><?php _e('Sermon Less','Awaken');?></option>
                      
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select the View','Awaken');?></p>
                </div>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Filterable','Awaken');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
				    <select name="cs_sermon_filterable[]" class="dropdown">
                      <option value="yes" <?php if($cs_sermon_filterable == 'yes'){echo 'selected="selected"';}?>><?php _e('Yes','Awaken');?></option>
                      <option value="no"  <?php if($cs_sermon_filterable == 'no'){echo 'selected="selected"';}?>><?php _e('No','Awaken');?></option>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select the View','Awaken');?></p>
                </div>
              </li>
            </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('No. of Post Per Page','Awaken');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <input type="text" name="cs_sermon_num_post[]" class="txtfield" value="<?php echo intval($cs_sermon_num_post); ?>" />
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
                <select name="sermon_pagination[]" class="dropdown">
                  <option <?php if($sermon_pagination=="Show Pagination")echo "selected";?> ><?php _e('Show Pagination','Awaken');?></option>
                  <option <?php if($sermon_pagination=="Single Page")echo "selected";?> ><?php _e('Single Page','Awaken');?></option>
                </select>
              </li>
            </ul>
            <?php 
                if ( function_exists( 'cs_shortcode_custom_classes' ) ) {
                    cs_shortcode_custom_dynamic_classes($cs_sermon_class,$cs_sermon_animation,'','cs_sermon');
                }
            ?>
            <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
            <ul class="form-elements insert-bg">
              <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo str_replace('cs_pb_','',$name);?>','<?php echo esc_attr($name.$cs_counter)?>','<?php echo esc_attr($filter_element);?>')" ><?php _e('Insert','Awaken');?></a> </li>
            </ul>
            <div id="results-shortocde"></div>
            <?php } else {?>
            <ul class="form-elements">
              <li class="to-label"></li>
              <li class="to-field">
                <input type="hidden" name="cs_orderby[]" value="sermon" />
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
	add_action('wp_ajax_cs_pb_sermon', 'cs_pb_sermon');
}
// Sermon html form for page builder end


//======================================================================
// Latest Sermon html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_latest_sermon' ) ) {
	function cs_pb_latest_sermon($die = 0){
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
			$PREFIX = 'cs_latest_sermon';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('cs_latest_sermon_section_title'=>'','cs_latest_sermon_cat'=>'','cs_sermon_text_color'=>'#fff','cs_latest_sermon_class' => '','cs_latest_sermon_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			$latest_sermon_element_size = '50';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_latest_sermon';
			$coloumn_class = 'column_'.$latest_sermon_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
    <div id="<?php echo esc_attr($name.$cs_counter)?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="latest_sermon" data="<?php echo element_size_data_array_index($latest_sermon_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$latest_sermon_element_size);?>
      <div class="cs-wrapp-class-<?php echo intval($cs_counter)?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter)?>" data-shortcode-template="[cs_latest_sermon {{attributes}}]"  style="display: none;">
        <div class="cs-heading-area">
          <h5><?php _e('Edit Sermon Options','Awaken');?></h5>
          <a href="javascript:removeoverlay('<?php echo esc_attr($name.$cs_counter)?>','<?php echo esc_attr($filter_element);?>')" class="cs-btnclose"><i class="fa fa-times"></i></a> </div>
        <div class="cs-pbwp-content">
          <div class="cs-wrapp-clone cs-shortcode-wrapp">
            <?php
             if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
            <ul class="form-elements">
                <li class="to-label"><label>Section Title</label></li>
                <li class="to-field">
                    <input  name="cs_latest_sermon_section_title[]" type="text"  value="<?php echo esc_attr($cs_latest_sermon_section_title)?>"   />
                </li>                  
             </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Choose Category','Awaken');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
                    <select name="cs_latest_sermon_cat[]" class="dropdown">
                      <option value="0"><?php _e('--Select Category--','Awaken');?></option>
                      <?php show_all_cats('', '', $cs_latest_sermon_cat, "sermon-category");?>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select category to show posts. If you dont select category it will display all posts','Awaken');?></p>
                </div>
              </li>
            </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Text Color','Awaken');?></label>
              </li>
              <li class="to-field">
                <input type="text" name="cs_sermon_text_color[]" class="bg_color" value="<?php echo esc_attr($cs_sermon_text_color)?>" />
              </li>
            </ul>
            

            <?php 
                if ( function_exists( 'cs_shortcode_custom_classes' ) ) {
                    cs_shortcode_custom_dynamic_classes($cs_latest_sermon_class,$cs_latest_sermon_animation,'','cs_latest_sermon');
                }
            ?>
            <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
            <ul class="form-elements insert-bg">
              <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo str_replace('cs_pb_','',$name);?>','<?php echo esc_attr($name.$cs_counter)?>','<?php echo esc_attr($filter_element);?>')" ><?php _e('Insert','Awaken');?></a> </li>
            </ul>
            <div id="results-shortocde"></div>
            <?php } else {?>
            <ul class="form-elements">
              <li class="to-label"></li>
              <li class="to-field">
                <input type="hidden" name="cs_orderby[]" value="latest_sermon" />
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
	add_action('wp_ajax_cs_pb_latest_sermon', 'cs_pb_latest_sermon');
}
// Latest Sermon html form for page builder end
