<?php
 
//======================================================================
// Adding Project Start
//======================================================================
if (!function_exists('cs_project_shortcode')) {
	function cs_project_shortcode( $atts ) {
		global $post, $wpdb, $cs_theme_options, $page_element_size,$cs_xmlObject;
		$defaults = array('column_size'=>'','cs_project_section_title'=>'','cs_project_view'=>'','cs_project_cat'=>'','cs_project_num_post'=>'10','cs_project_pagination'=>'','cs_project_class' => '','cs_project_animation' => '');
		
		extract( shortcode_atts( $defaults, $atts ) );
				
		ob_start();
		
		if (isset($cs_xmlObject->sidebar_layout) && $cs_xmlObject->sidebar_layout->cs_page_layout <> '' and $cs_xmlObject->sidebar_layout->cs_page_layout <> "none"){				
				$cs_project_medium_layout = 'col-md-4';
		}else{
				$cs_project_medium_layout = 'col-md-3';	
		}
		$html = '';
		$CustomId = '';
		if ( isset( $cs_project_class ) && $cs_project_class ) {
			$CustomId = ' id="'.$cs_project_class.'"';
		}
		
		if ( trim($cs_project_animation) != '' ) {
			$cs_project_animation = ' class="wow'.' '.$cs_project_animation.'"';
		} else {
			$cs_project_animation = '';
		}
		if(isset($atts['cs_project_section_title']) && trim($atts['cs_project_section_title']) <> ''){
			echo '<div class="main-title col-md-12"><div class="cs-section-title"><h2>'.$cs_project_section_title.'</h2></div></div>';
		}
		
		echo '<div '.cs_allow_special_char($CustomId).''.cs_allow_special_char($cs_project_animation).'>';
		
			$projectTemplates = new ProjectTemplates();
			if($cs_project_view == 'project-medium'){
				$html .= $projectTemplates->cs_project_medium_view( $atts, $cs_project_medium_layout );
			}
			else if($cs_project_view == 'project-small'){
				$html .= $projectTemplates->cs_project_small_view( $atts );
			}else if($cs_project_view == 'project-three-column'){
				
				$html .= $projectTemplates->cs_project_grid_three_column( $atts );
			}
			else{
				$html .= $projectTemplates->cs_project_classic_view( $atts );
			}
			
		echo '</div>';
		
		$project_data = ob_get_clean();

        return do_shortcode($project_data);
    }
	
	add_shortcode( 'cs_project', 'cs_project_shortcode' );
}