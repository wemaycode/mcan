<?php

// Sermons
if ( ! function_exists( 'cs_sermons_listing_section' ) ) {
	function cs_sermons_listing_section(){
		global $post,$cs_xmlObject;
		if(isset($cs_xmlObject)){
			$sermon_audio_url 			= isset($cs_xmlObject->sermon_audio_url)?$cs_xmlObject->sermon_audio_url:'';
			$sermon_audio_download_link = isset($cs_xmlObject->sermon_audio_download_link)?$cs_xmlObject->sermon_audio_download_link:'';
			$sermon_notes_link			= isset($cs_xmlObject->sermon_notes_link)?$cs_xmlObject->sermon_notes_link:'';
			$sermon_summery			= isset($cs_xmlObject->sermon_summery)?$cs_xmlObject->sermon_summery:'';
			$sermon_speaker			= isset($cs_xmlObject->sermon_speaker)?$cs_xmlObject->sermon_speaker:'';
		}else{
			$sermon_audio_url = $sermon_audio_download_link = $sermon_notes_link = $sermon_summery = $sermon_speaker = '';
		}
	?>

	
	<ul class="form-elements">
      <li class="to-label">
        <label><?php _e('Speaker','Awaken');?></label>
      </li>
      <li class="to-field">
			<input id="sermon_speaker" name="sermon_speaker" value="<?php echo esc_attr($sermon_speaker); ?>" type="text" />
             
      </li>
    </ul>
	
	<ul class="form-elements">
      <li class="to-label">
        <label><?php _e('Notes Link','Awaken');?></label>
      </li>
      <li class="to-field">
			<input id="sermon_notes_link" name="sermon_notes_link" value="<?php echo esc_attr($sermon_notes_link); ?>" type="text" class="small" />
             <input id="sermon_notes_link" name="sermon_notes_link" type="button" class="uploadMedia left" value="Browse"/>
      </li>
    </ul>
	
	<ul class="form-elements">
      <li class="to-label">
        <label><?php _e('Download Audio Link','Awaken');?></label>
      </li>
      <li class="to-field">
			<input id="sermon_audio_download_link" name="sermon_audio_download_link" value="<?php echo esc_attr($sermon_audio_download_link); ?>" type="text" class="small" />
             <input id="sermon_audio_download_link" name="sermon_audio_download_link" type="button" class="uploadMedia left" value="Browse"/>
      </li>
    </ul>
	
	<ul class="form-elements">
      <li class="to-label">
        <label><?php _e('Sermon Summery','Awaken');?></label>
      </li>
      <li class="to-field">
			<textarea id="sermon_summery" name="sermon_summery"><?php echo esc_attr($sermon_summery); ?></textarea>
      </li>
    </ul>

	<div class="boxes tracklists">
	  <div id="add_sermon_listings" style="display: none;">
		<div class="cs-heading-area">
		  <h5> <i class="fa fa-plus-circle"></i> <?php _e('Sermon Listings','Awaken');?> </h5>
		  <span onClick="javascript:removeoverlay('add_sermon_listings','append')" class="cs-btnclose"><i class="fa fa-times"></i></span> </div>
         <ul class="form-elements">
		  <li class="to-label">
			<label><?php _e('Sermon Title','Awaken');?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="sermon_title" name="sermon_title" value="" />
		  </li>
		</ul>
        <ul class="form-elements">
		  <li class="to-label">
			<label><?php _e('Sermon Url','Awaken');?></label>
		  </li>
		  <li class="to-field">
          	<input id="sermon_file_url" name="sermon_file_url" value="" type="text" class="small" />
             <input id="sermon_file_url" name="sermon_file_url" type="button" class="uploadMedia left" value="Browse"/>
		  </li>
		</ul>
		
		<ul class="form-elements noborder">
		  <li class="to-label"></li>
		  <li class="to-field">
			<input type="button" value="Add Sermon" onClick="add_sermon_to_list('<?php echo esc_js(admin_url('admin-ajax.php'))?>', '<?php echo esc_js(get_template_directory_uri())?>')" />
		  </li>
		</ul>
	  </div>
	  	<script>
			jQuery(document).ready(function($) {
				$("#total_project_names").sortable({
					cancel : 'td div.cancel-drag',
				});
			});
		</script>
	  <div class="opt-head">
		<h4 style="padding-top:12px;"></h4>
		<a href="javascript:_createpop('add_sermon_listings','filter')" class="button"><?php _e('Add Sermon','Awaken');?></a>
		<div class="clear"></div>
	  </div>
	  <table class="to-table" border="0" cellspacing="0">
		<thead>
		  <tr>
			<th style="width:20%;"><?php _e('Sermon Title','Awaken');?></th>
			<th style="width:20%;"><?php _e('Sermon URL','Awaken');?></th>
			<th style="width:20%;" class="centr"><?php _e('Actions','Awaken');?></th>
		  </tr>
		</thead>
		<tbody id="total_sermon_names">
		  <?php
				global $counter_sermons, $sermon_title,  $sermon_file_url;
				$counter_sermons = $post->ID;
				if(isset($cs_xmlObject->sermons) && count($cs_xmlObject->sermons)){
					foreach ( $cs_xmlObject->sermons as $transct ){
							
							$sermon_title = $transct->sermon_title;
							
							$sermon_file_url = $transct->sermon_file_url;
							$counter_sermons++;
							add_sermon_name_to_list();
					}
				}
			?>
		</tbody>
	  </table>
	</div>
	
	<?php
	}
}



// Add Sermon to cause list
if ( ! function_exists( 'add_sermon_name_to_list' ) ) {
	add_action('wp_ajax_add_sermon_name_to_list', 'add_sermon_name_to_list');
	function add_sermon_name_to_list(){
		global $counter_sermons, $sermon_title, $sermon_file_url;
		foreach ($_POST as $keys=>$values) {
			$$keys = $values;
		}
	?>
		<tr id="edit_track<?php echo esc_attr($counter_sermons)?>">
	
			<td id="sermon_title<?php echo esc_attr($counter_sermons)?>" style="width:20%;"><?php echo esc_attr($sermon_title)?></td>
	
			<td id="sermon_file_url<?php echo esc_attr($counter_sermons)?>" style="width:20%;"><?php echo esc_attr($sermon_file_url)?></td>

			<td class="centr" style="width:20%;">
	
				<a href="javascript:_createpop('edit_track_form<?php echo esc_attr($counter_sermons)?>','filter')" class="actions edit">&nbsp;</a>
	
				<a onclick="javascript:return confirm('Are you sure! You want to delete this Sermon')" href="javascript:cs_div_remove('edit_track<?php echo esc_attr($counter_sermons)?>')" class="actions delete">&nbsp;</a>
	
				<div class="cancel-drag" id="edit_track_form<?php echo esc_attr($counter_sermons)?>" style="display:none;">
	
					<div class="cs-heading-area">
	
						<h5><?php _e('Edit Sermon','Awaken');?></h5>
	
						<span onclick="javascript:removeoverlay('edit_track_form<?php echo esc_attr($counter_sermons)?>','append')" class="cs-btnclose"><i class="fa fa-times"></i></span>
	
						<div class="clear"></div>
	
					</div>
	
					<ul class="form-elements">
	
						<li class="to-label"><label><?php _e('Sermon Title','Awaken');?></label></li>
	
						<li class="to-field"><input type="text" name="sermon_title_array[]" value="<?php echo htmlspecialchars($sermon_title)?>" id="sermon_title<?php echo esc_attr($counter_sermons);?>" /></li>
	
					</ul>
	
					<ul class="form-elements">
	
						<li class="to-label"><label><?php _e('Sermon Url','Awaken');?></label></li>
	
						<li class="to-field">
                        	<input id="sermon_file_url<?php echo esc_attr($counter_sermons);?>" name="sermon_file_url_array[]" value="<?php echo esc_url($sermon_file_url)?>" type="text" class="small" />
             				<input id="sermon_file_url<?php echo esc_attr($counter_sermons);?>" name="sermon_file_url_array[]" type="button" class="uploadMedia left" value="Browse"/>
					</ul>
	
					<ul class="form-elements noborder">
	
						<li class="to-label"><label></label></li>
	
						<li class="to-field"><input type="button" value="Update Sermon" onclick="update_title(<?php echo esc_js($counter_sermons)?>); removeoverlay('edit_track_form<?php echo esc_js($counter_sermons)?>','append')" /></li>
	
					</ul>
	
				</div>
	
			</td>
	
		</tr>
	
	<?php
	
	}
}

?>