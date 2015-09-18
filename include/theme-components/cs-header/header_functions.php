<?php
/**
 * The template for Settings up Functions
 */
 
/** 
 * @Get logo
 *
 *
 */
global $cs_theme_options;
if ( ! function_exists( 'cs_logo' ) ) {
	function cs_logo(){
		global $cs_theme_options;
		$logo = $cs_theme_options['cs_custom_logo'];
		?>
		<a href="<?php echo home_url(); ?>">	
			<img src="<?php echo esc_url($logo); ?>" style="width:<?php echo cs_allow_special_char($cs_theme_options['cs_logo_width']);?>px; height: <?php echo cs_allow_special_char($cs_theme_options['cs_logo_height']);?>px;" alt="<?php bloginfo('name'); ?>">
        </a>
	<?php
	}
}

/** 
 * @Set Header Position
 *
 *
 */
if ( ! function_exists( 'cs_header_postion_class' ) ) {
	function cs_header_postion_class(){
		global $cs_theme_options;
		return 'header-'.$cs_theme_options['cs_header_position'];
	}
}

/** 
 * @Set Header strip
 *
 *
 */
if ( ! function_exists( 'cs_header_strip' ) ) {
	function cs_header_strip($container = 'on'){
		global $cs_theme_options;
		$cs_header_options = $cs_theme_options['cs_header_options'];
		$cs_socail_icon_switch = $cs_theme_options['cs_socail_icon_switch'];
		$cs_search = $cs_theme_options['cs_search'];
	
		$cs_top_menu_switch = $cs_theme_options['cs_top_menu_switch'];
		if(isset($cs_theme_options['cs_woocommerce_switch'])){ $cs_woocommerce_switch =$cs_theme_options['cs_woocommerce_switch'];}else{ $cs_woocommerce_switch = '';}
		if(isset($cs_theme_options['cs_wpml_switch'])){ $cs_wpml_switch = $cs_theme_options['cs_wpml_switch']; }else{ $cs_wpml_switch = '';}
		$cs_login_options = $cs_theme_options['cs_login_options'];
		$cs_header_strip_tagline_text = htmlspecialchars_decode($cs_theme_options['cs_header_strip_tagline_text']);
		if($cs_header_strip_tagline_text == 'on' || $cs_top_menu_switch=='on' || $cs_login_options=='on' || $cs_socail_icon_switch=='on'){ ?>
<!-- Top Strip -->

<?php
    if(isset($cs_theme_options['cs_header_top_strip']) and $cs_theme_options['cs_header_top_strip'] == 'on'){
    ?>
    <section class="top-bar"> 
      <!-- Container -->
      <?php if($container == 'on'){ ?>
      <div class="container"> 
      <?php } ?>
     	
        
        <!-- Left Side -->
        <aside class="left-side">
         <?php if(isset($cs_socail_icon_switch) and $cs_socail_icon_switch=='on'){ 
           	  cs_social_network();
           } ?>
          <div class="cs-login-sec">
            <ul>
            <?php if( class_exists( 'wp_causes' ) ){ do_shortcode('[cs_get_login_nav]'); }?>
            <?php 
			/*if(isset($cs_login_options) and $cs_login_options =='on'){?>
              			<li><a href="#" class="cs-user"><?php _e('Login/Register','Awaken');?></a></li>
             <?php }*/
			  ?>
              
			 <?php 
                if ( function_exists('icl_object_id') ) {
                     ?>
				<li>
					<div class="language-sec"> 
						<!-- Language Section --> 
							<?php echo do_action('icl_language_selector');?> 
							<!-- Language Section --> 
					</div>
				</li>
		  <?php  
                    }
					
					if ( function_exists( 'is_woocommerce' ) ){
					 if($cs_woocommerce_switch == 'on'){
						 echo '<div class="cart-sec">';
							 cs_woocommerce_header_cart();
             		 	 echo '</div>';
					 }
				}
					?>
                
              
            </ul>
          </div>

        </aside>

		<!-- Right Side -->
        <aside class="right-side">
        <?php /*if(isset($cs_top_menu_switch) and $cs_top_menu_switch=='on'){ ?>
          <nav class="top-nav">
              <?php cs_navigation('top-menu','','','1'); ?>
          </nav>
          <?php }
          if(isset($cs_header_strip_tagline_text) and $cs_header_strip_tagline_text <> ''){ ?>
          		<p><?php echo do_shortcode($cs_header_strip_tagline_text);?></p>
          <?php 
            } 
            */?>
        </aside>
		
        <!-- Right Section -->
 	 <!-- Container -->
      <?php if($container == 'on'){ ?>
      </div>
      <?php } ?>
      <!-- Container --> 
    </section>
<!-- Top Strip -->
<?php 
	}
		}
	}
}


/*-----------------------------------------------------------------------------------*/
# @Categories Mega Menus
/*-----------------------------------------------------------------------------------*/
if (!class_exists('cs_mega_menu_walker')) { 
	class cs_mega_menu_walker extends Walker_Nav_Menu {
		private $CurrentItem, $CategoryMenu, $menu_style;
		function cs_menu_start(){
			$sub_class = $last ='';
			$count_menu_posts = 0;
			$mega_menu_output = '';
		}
		function start_lvl( &$output, $depth = 0, $args = array(), $id=0 ) {
			$indent = str_repeat("\t", $depth);
			$bg =$this->CurrentItem->bg;
			$output .= $this->cs_menu_start();
			if( $this->CurrentItem->megamenu == 'on' && $depth == 0){
 					$output .= "\n$indent<ul class=\"mega-grid\" >\n";	
  			} else {
				$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
			}
		}
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul> <!--End Sub Menu -->\n";
			
			if( $this->CurrentItem->megamenu == 'on' && $depth == 0){
			}
		}
		function start_el(&$output, $item, $depth = 0, $args = array() , $id = 0) {
			global $wp_query;
 			$this->CurrentItem = $item;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			if($depth == 0){
				$class_names = $value = '';
				$mega_menu = 'dropdown sub-menu cs-mega-menu';
			} else if($args->has_children){
				$class_names = $value = '';
				$mega_menu = 'dropdown parentIcon  cs-sub-menu';
			} else {
				$class_names = $value = $mega_menu = '';
			}
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
  			if($item->object == 'page' && empty($item->menu_item_parent) or $item->object == 'custom'){
 				if( $this->CurrentItem->megamenu== 'on' ){
					$mega_menu = 'mega-menu';
					if( $this->CurrentItem->megamenu == 'on'){
						$mega_menu = 'dropdown mega-menu cs-mega-menu';
					}
					if( $this->CurrentItem->megamenu == 'on' &&  isset($category_options['menu_style']) && $category_options['menu_style'] == 'Category Post'){
						$mega_menu = 'dropdown mega-menu-v2';
					}
					if ( empty($args->has_children) ) $mega_menu .= ' full-mega-menu';
				} else {
					$mega_menu = 'dropdown sub-menu';
				}
			}
			$class_names = join( " $mega_menu ", apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="'. esc_attr( $class_names ) . '"';
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
 			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			if( $this->CurrentItem->link != 'on'){
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			}
			$item_output = $args->before;
			
			if( $this->CurrentItem->text != 'on'){
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= $args->link_after;
				$item_output .= '</a>';
			}
			
			$item_output .= ! empty( $item->description )     ? ' <p>' . esc_attr( $item->description ) .'</p>' : '';
			$item_output .= $args->after;
			if( !empty($mega_menu) && empty($args->has_children) && $this->CurrentItem->megamenu == 'on' ){	
				$item_output .= $this->cs_menu_start();
			}
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
		}
		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			}
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
	}
}

/**
 * @Top and Main Navigation
 *
 *
 */
if ( ! function_exists( 'cs_navigation' ) ) {
	function cs_navigation($nav='', $menus = 'menus', $menu_class = '', $depth='0'){
		global $cs_theme_options;	
		if ( has_nav_menu( $nav ) ) {
			if (class_exists('cs_mega_menu_walker')) {
				$defaults = array(
				'theme_location' => "$nav",
				'menu' => '',
				'container' => '',
				'container_class' => '',
				'container_id' => '',
				'menu_class' => "$menu_class",
				'menu_id' => "$menus",
				'echo' => false,
				'fallback_cb' => 'wp_page_menu',
				'before' => '',
				'after' => '',
				'link_before' => '',
				'link_after' => '',
				'items_wrap' => '<ul class="%1$s">%3$s</ul>',
				'depth' => "$depth",
				'walker' => new cs_mega_menu_walker());
	
				} else {
					
				$defaults = array(

					'theme_location' => "$nav",
					'menu' => '',
					'container' => '',
					'container_class' => '',
					'container_id' => '',
					'menu_class' => "$menu_class",
					'menu_id' => "$menus",
					'echo' => false,
					'fallback_cb' => 'wp_page_menu',
					'before' => '',
					'after' => '',
					'link_before' => '',
					'link_after' => '',
					'items_wrap' => '<ul class="%1$s">%3$s</ul>',
					'depth' => "$depth",
					'walker' => '',);
			}
			echo do_shortcode(wp_nav_menu($defaults));
		} else {
			
			
				$defaults = array(
				'theme_location' => "",
				'menu' => '',
				'container' => '',
				'container_class' => '',
				'container_id' => '',
				'menu_class' => "$menu_class",
				'menu_id' => "$menus",
				'echo' => false,
				'fallback_cb' => 'wp_page_menu',
				'before' => '',
				'after' => '',
				'link_before' => '',
				'link_after' => '',
				'items_wrap' => '<ul class="%1$s">%3$s</ul>',
				'depth' => "$depth",
				'walker' => '',);
	
			echo do_shortcode(str_replace('sub-menu', 'dropdown-menu',(wp_nav_menu($defaults))));
		}
		
	}
}

/** 
 * @Header search function
 *
 *
 */
if ( ! function_exists( 'cs_search' ) ) {
	function cs_search($search_class='cs-searchv2'){
			global $cs_theme_options;
		?>
<div class="search-top <?php echo cs_allow_special_char($search_class);?>">
  <form id="searchform" method="get" action="<?php echo home_url()?>"  role="search">
    <input type="text" name="s" id="searchinput" value="<?php _e('Enter your search','Awaken'); ?>" onblur="if(this.value == '') { this.value ='<?php _e('Enter your search','Awaken'); ?>'; }" onfocus="if(this.value =='<?php _e('Enter your search','Awaken'); ?>') { this.value = ''; }"  >
    
      <input type="submit" value="" name="submit">
    
  </form>
</div>
<?php
	}
}
// Contribute Now Button
if(!function_exists('cs_contribute_now')){
	function cs_contribute_now(){
		global $cs_theme_options;
		$cs_contribute_now_link = (isset($cs_theme_options['cs_contribute_now_link'])) ? $cs_theme_options['cs_contribute_now_link'] : '';
		if(isset($cs_theme_options['cs_contribute_now']) and $cs_theme_options['cs_contribute_now']=='on' and $cs_contribute_now_link <> ''){
			echo '<a class="btn-style1" href="'.$cs_contribute_now_link.'"><i class="fa fa-database"></i>'.__('Contribute Now','Awaken').'</a>';
		}
	}
	
}
/*
 *
 *@ Header 
 *
*/
if ( ! function_exists( 'cs_get_headers' ) ) {
	function cs_get_headers(){
		global $cs_theme_options;
		$cs_header_options = $cs_theme_options['cs_header_options'];
		$cs_socail_icon_switch = $cs_theme_options['cs_socail_icon_switch'];
		$cs_header_tagline_switch = $cs_theme_options['cs_header_tagline_switch'];
		$cs_search = $cs_theme_options['cs_search'];
		$cs_login_options = $cs_theme_options['cs_login_options'];
		$header_top_menu = $cs_theme_options['cs_top_menu_switch'];
		if(isset($cs_theme_options['cs_wpml_switch'])){ $cs_wpml_switch = $cs_theme_options['cs_wpml_switch']; }else{ $cs_wpml_switch = '';}
		$cs_login_options = $cs_theme_options['cs_login_options'];
		
		if(isset($cs_header_options) and $cs_header_options=='header_1'){
	?>
<!-- Header Start -->
<header id="main-header" class="<?php echo cs_allow_special_char($cs_header_options);?>">
  <!-- Main Header -->
  <div class="main-head"> 
    <!-- Container -->
    <div class="container">
      <aside class="left-side">
        	<div class="logo"><?php cs_logo(); ?></div>
      </aside>
      <aside class="right-side">
        <!-- Navigation Start -->
        
        <nav class="navbar navigation"> 
        	
            <?php 
				echo '<div class="navbar-default"><div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					</div></div><div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">';
					cs_header_main_navigation(); echo '</div>';	
 				 
			?>
        </nav>
        <!-- Navigation End -->
        <?php cs_contribute_now(); ?>
      </aside>
    </div>
    <!-- Container --> 
  </div>
  <!-- Main Header --> 
</header>
<!-- Header End --> 
<!-- Header 1 End -->
<?php }
		elseif(isset($cs_header_options) and $cs_header_options=='header_2'){?>
<header id="main-header" class="<?php echo cs_allow_special_char($cs_header_options);?>"> 
  <!-- Top Strip -->
  <?php cs_header_strip();?>
  <!-- End Top Strip -->
  <!-- Logo Section -->
  <section class="logo-section" style=" background-color: #ffffff; ">
      <div class="container">
        <aside class="left-side">
            <div class="logo"><?php cs_logo(); ?></div>
            <?php 
				if(isset($cs_header_tagline_switch) and  $cs_header_tagline_switch=='on'){
					echo '<p>'.get_bloginfo('description').'</p>';
				} 
			 ?>
          </aside>
          <aside class="right-side">
			<!-- Top Nav -->
			<?php cs_top_navigation(); ?>
			<div class="main-navbar">
				<?php cs_main_navigation(); ?>
			</div>
			<?php cs_contribute_now(); ?> 
			<!-- End Top Nav -->
		</aside>
      </div>
    </section>
  <!-- End Logo Section -->
  
  <!-- Main Navigation -->
  <!--
  <section class="main-navbar" style="background-color: #e17a26; ">
      <div class="container">
        <aside class="left-side">
           <?php //cs_main_navigation(); ?>
        </aside>
        <aside class="right-side">
          <?php
			/*
			if(isset($cs_search) and  $cs_search=='on'){
				cs_search();
			}
			*/
			?>
        </aside>
	</div>
    </section>
	-->
   <!-- End Main Navigation --> 
</header>
<!-- Header 2 End -->
<?php }
		elseif(isset($cs_header_options) and $cs_header_options=='header_3'){?>
<!-- Header 3 Start -->
<header id="main-header" class="<?php echo cs_allow_special_char($cs_header_options);?>">
	<!-- Top Strip -->
  <?php cs_header_strip();?>
	<!-- Top Strip -->
    <!-- Logo Section -->
    <section class="logo-section" style=" background-color: #1d1d1d; ">
      
      <div class="container">
        <aside class="left-side">
            <div class="logo"><?php cs_logo(); ?></div>
            <?php 
				if(isset($cs_header_tagline_switch) and  $cs_header_tagline_switch=='on'){
			
					echo '<p>'.get_bloginfo('description').'</p>';
             } ?>
          </aside>
          <aside class="right-side"> <?php cs_contribute_now(); ?> 

		  </aside>
      </div>

    </section>
    <!-- Logo Section --> 
   <!-- Main Navbar -->
    <section class="main-navbar" style=" background-color: #0e0e0e; ">
      <div class="container">
        <aside class="left-side">
          <?php cs_main_navigation(); ?>
		</aside>
	  <aside class="right-side">
		<?php
			if(isset($cs_search) and  $cs_search=='on'){
				cs_search();
			}
		?>
	  </aside>
	  </div>
	 </section>
  <!-- Main Navbar --> 
</header>
<!-- Header 3 End -->
<?php }
		elseif(isset($cs_header_options) and $cs_header_options=='header_4'){?>
<header id="main-header" class="<?php echo cs_allow_special_char($cs_header_options);?>"> 
	<div class="container">
      <!-- Top Strip -->
      <?php cs_header_strip($container ='off');?>
      <!-- Top Strip --> 
    <!-- Logo Section -->
    <section class="logo-section">
      
        <aside class="left-side">
            <div class="logo"><?php cs_logo(); ?></div>
            <?php 
				if(isset($cs_header_tagline_switch) and  $cs_header_tagline_switch=='on'){
			
					echo '<p>'.get_bloginfo('description').'</p>';
             } ?>
          </aside>
          <aside class="right-side">
			<?php cs_contribute_now();  ?>
          </aside>
     
    </section>
    <!-- Logo Section -->
	<!-- Main Navbar -->
    <section class="main-navbar">
      
        <aside class="left-side">
        
          <?php cs_main_navigation(); ?>
		  
		</aside>
		<aside class="right-side">
		<?php
			if(isset($cs_search) and  $cs_search=='on'){
				cs_search();
			}
		?>
		</aside>
	 
	</section>
	<!-- Main Navbar -->
    </div>
</header>
<!-- Header 4 End -->
<?php }
		else {?>
	<!-- Header Start -->
	<header id="main-header"> 
  <!-- Top Strip -->
  <?php cs_header_strip();?>
  <!-- Top Strip --> 
  <!-- Main Header -->
  <div class="main-head"> 
    <!-- Container -->
    <div class="container">
      <aside class="logo">
        <?php cs_logo(); ?>
      </aside>
      <!-- Navigation Start -->
      <?php cs_main_navigation(); ?>
      <!-- Navigation End -->
      <aside class="cs-login-sec">
        <ul>
          <?php if(isset($cs_search) and $cs_search=='on'){ ?>
          <li><a class="cs-search"><i class="fa fa-search"></i></a>
            <?php cs_search();?>
          </li>
          <?php } ?>
        </ul>
      </aside>
    </div>
    <!-- Container --> 
  </div>
  <!-- Main Header --> 
</header>
	<!-- Header End --> 
	<!-- Header 1 End -->
<?php }
			
	}
}

/** 
 * @Main navigation
 *
 *
 */
if ( ! function_exists( 'cs_header_main_navigation' ) ) {
function cs_header_main_navigation(){
		global $post,$cs_xmlObject;
		$post_type = get_post_type(get_the_ID());
		if(is_page()){
			$meta_element = 'cs_page_builder';
		}else if(function_exists("is_shop") and is_shop()){
			$post_ID = woocommerce_get_page_id( 'shop' );
			$meta_element = 'cs_page_builder';
		} else if(is_single() && $post_type != 'post'){
			$meta_element = 'dynamic_cusotm_post';
		} else {
			$meta_element = 'post';
		}
		
		$post_meta = get_post_meta(get_the_ID(), "$meta_element", true);
		if ( $post_meta <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_meta);
		}
		
		if( function_exists("is_shop") and !is_shop() ){ 
			if( is_author() || is_search() || is_archive() || is_category() ){ 
				$cs_xmlObject = new stdClass();
				$cs_xmlObject->header_banner_style = '';
			}
		}
		else if(!function_exists("is_shop")){
			if( is_author() || is_search() || is_archive() || is_category() ){ 
				$cs_xmlObject = new stdClass();
				$cs_xmlObject->header_banner_style = '';
			}
		}
		
		if ( empty($cs_xmlObject->page_custom_menu) ) $page_custom_menu = ""; else $page_custom_menu = $cs_xmlObject->page_custom_menu;
		if($page_custom_menu != '' && $page_custom_menu != 'default'){
			cs_navigation("$page_custom_menu",'nav navbar-nav');
		} else {
			cs_navigation('main-menu','nav navbar-nav');	
		}
	}
}

 
/** 
 * @Subheader Style
 *
 *
 */
if ( ! function_exists( 'cs_subheader_style' ) ) {
	function cs_subheader_style($post_ID=''){
		global $post, $wp_query, $cs_theme_options, $cs_xmlObject;
 		$post_type = get_post_type(get_the_ID());
		$post_ID = get_the_ID();
		
 		if(is_page()){
			$meta_element = 'cs_page_builder';
		} else if(function_exists("is_shop") and is_shop()){
			$post_ID = woocommerce_get_page_id( 'shop' );
			$meta_element = 'cs_page_builder';
		} else if(is_single() && $post_type == 'sermons'){
			$meta_element = 'sermons';
			
		}else if(is_single() && $post_type == 'events'){
			$meta_element = 'events';
			
		}else if(is_single() && $post_type == 'project'){
			$meta_element = 'csprojects';
			
		}else if(is_single() && $post_type == 'causes'){
			$meta_element = 'cs_cause_meta';
			
		}else if(is_single() && $post_type == 'product'){
			$meta_element = 'product';
		} else if(is_single() && $post_type != 'post'){
			 $meta_element = 'dynamic_cusotm_post';
		} else {
			$meta_element = 'post';
		}
		
 		$post_meta = get_post_meta($post_ID, "$meta_element", true);
		if ( $post_meta <> "" ){
			$cs_xmlObject = new SimpleXMLElement($post_meta);
		}

		if( function_exists("is_shop") and !is_shop() ){ 
			if( is_author() || is_search() || is_archive() || is_category() ){ 
				$cs_xmlObject = new stdClass();
				$cs_xmlObject->header_banner_style = '';
			}
		}
		else if(!function_exists("is_shop")){
			if( is_author() || is_search() || is_archive() || is_category() ){ 
				$cs_xmlObject = new stdClass();
				$cs_xmlObject->header_banner_style = '';
			}
		}
 			
			if(isset($cs_xmlObject->header_banner_style) && $cs_xmlObject->header_banner_style == 'no-header'){
				// Do Nothing
			} else if(isset($cs_xmlObject->header_banner_style) && $cs_xmlObject->header_banner_style == 'breadcrumb_header'){
				cs_breadcrumb_header( $post_ID );
			} else if(isset($cs_xmlObject->header_banner_style) && $cs_xmlObject->header_banner_style == 'custom_slider'){
				cs_shortcode_slider('pages');
			} else if(isset($cs_xmlObject->header_banner_style) && $cs_xmlObject->header_banner_style == 'map'){
				cs_shortcode_map();
			} else if ( $cs_theme_options['cs_default_header']) {
				if ( $cs_theme_options['cs_default_header']  == 'No sub Header') {
					// Do Noting
				} else if ( $cs_theme_options['cs_default_header']  == 'Breadcrumbs Sub Header') {
					cs_breadcrumb_header( $post_ID );
				} else if ( $cs_theme_options['cs_default_header']  == 'Revolution Slider') {
					cs_shortcode_slider('default-pages');
				}
			}
	}
}


/** 
 * @Custom Slider by using shortcode
 *
 *
 */
if ( ! function_exists( 'cs_shortcode_slider' ) ) {
	function cs_shortcode_slider($type=''){
		global $post, $cs_xmlObject,$cs_theme_options;
		if ( $type == 'pages' ){
			if ( empty($cs_xmlObject->custom_slider_id) ) $custom_slider_id = ""; else $custom_slider_id = htmlspecialchars($cs_xmlObject->custom_slider_id);
		} else {
			if ( empty($cs_theme_options['cs_custom_slider']) ) $custom_slider_id = ""; else $custom_slider_id = htmlspecialchars($cs_theme_options['cs_custom_slider']);
		}
		
		if(isset($custom_slider_id) && $custom_slider_id != ''){
		?>
			<div class="cs-banner"> <?php echo do_shortcode( '[rev_slider ' . $custom_slider_id . ']' );?> </div>
		<?php
		}
	}
}

/** 
 * @Custom Map by using shortcode
 *
 *
 */
if ( ! function_exists( 'cs_shortcode_map' ) ) {
	function cs_shortcode_map(){
		global $post, $cs_xmlObject,$header_map;
		if ( empty($cs_xmlObject->custom_map) ) $custom_map = ""; else $custom_map = html_entity_decode($cs_xmlObject->custom_map);
		if(isset($custom_map) && $custom_map != ''){
			$header_map	= true;
		?>
            <div class="cs-map"> <?php echo do_shortcode($custom_map);?> </div>
        <?php
		}
	}
}

/** 
 * @Breadcrumb Header
 *
 *
 */
if ( ! function_exists( 'cs_breadcrumb_header' ) ) {
	function cs_breadcrumb_header($post_ID=''){
		global $post, $wp_query, $cs_theme_options,$cs_xmlObject;
 		
		$breadcrumSectionStart	= '';
		$breadcrumSectionEnd	= '';
		
 		if( class_exists('Woocommerce') && is_shop() ){
			$cs_page_bulider = get_post_meta($post_ID, "cs_page_builder", true);
			$cs_xmlObject = new stdClass();
			if(isset($cs_page_bulider) && $cs_page_bulider<>''){
				$cs_xmlObject = new SimpleXMLElement($cs_page_bulider);
			}
		}
		
 	 	if( is_page() || is_single() || ( class_exists('Woocommerce') && is_shop()) ){
			if(isset($post) && $post <> ''){
				$post_ID = $post->ID;
			}else{
				$post_ID = '';
			}
			$post_type = get_post_type( $post_ID );
		}
		
		$staticContainerStart	 = '';
		$staticContainerEnd		 = '';
		$banner_image_height 	 = '200';
		$cs_sh_paddingtop	 	 = '';
		$cs_sh_paddingbottom	 = '';
		$isDeafultSubHeader		 = 'false';
		if( function_exists("is_shop") and !is_shop() ){ 
			if ( is_author() || is_search() || is_archive() || is_category() || is_home()  ) {
				$isDeafultSubHeader	= 'true';
			}
		}
		else if(!function_exists("is_shop")){
			if ( is_author() || is_search() || is_archive() || is_category() || is_home()  ) {
				$isDeafultSubHeader	= 'true';
			}
		}
		
		if ( isset( $cs_xmlObject->header_banner_style ) && $cs_xmlObject->header_banner_style == 'default_header' ) {
			//Padding Top & Bottom 
			if ( isset ( $cs_theme_options['subheader_padding_switch'] ) && $cs_theme_options['subheader_padding_switch'] == 'custom' ) {
				if ( empty($cs_theme_options['cs_sh_paddingtop']) ) $cs_sh_paddingtop = ""; else $cs_sh_paddingtop = 'padding-top:'.$cs_theme_options['cs_sh_paddingtop'].'px;';
				if ( empty($cs_theme_options['cs_sh_paddingbottom']) ) $cs_sh_paddingbottom = ""; else $cs_sh_paddingbottom = 'padding-bottom:'.$cs_theme_options['cs_sh_paddingbottom'].'px;';
			}
			
			//
			
			$page_subheader_color = (isset($cs_theme_options['cs_sub_header_bg_color']) and $cs_theme_options['cs_sub_header_bg_color']<>'' )?$cs_theme_options['cs_sub_header_bg_color']:'';
			$page_subheader_text_color = (isset($cs_theme_options['cs_sub_header_text_color']) and $cs_theme_options['cs_sub_header_text_color']<>'' )?$cs_theme_options['cs_sub_header_text_color']:'';
			
		
		
		 if ( isset( $cs_xmlObject->page_subheader_no_image ) && $cs_xmlObject->page_subheader_no_image !='' && $isDeafultSubHeader == 'false'  ) {  
				
				if ( isset( $cs_xmlObject->header_banner_image ) && $cs_xmlObject->header_banner_image !=''  ) { 
					$header_banner_image = $cs_xmlObject->header_banner_image;
				} else if ( isset( $cs_theme_options['cs_background_img'] ) && $cs_theme_options['cs_background_img'] !=''  ) { 
					$header_banner_image = $cs_theme_options['cs_background_img'];
				} else {
					$header_banner_image = "";
				}
				
				if ( isset( $cs_xmlObject->page_subheader_parallax ) && $cs_xmlObject->page_subheader_parallax !=''  ) { 
					$page_subheader_parallax = $cs_xmlObject->page_subheader_parallax;
				} else if ( isset( $cs_theme_options['cs_parallax_bg_switch'] ) && $cs_theme_options['cs_parallax_bg_switch'] !=''  ) { 
					$page_subheader_parallax = $cs_theme_options['cs_parallax_bg_switch'];
				} else {
					$page_subheader_parallax = "";
				}
			
			} else {
				$page_subheader_parallax = "";
				$header_banner_image     = "";
			}
		} else {
				if ( $isDeafultSubHeader == 'true' ) {
					
						if ( isset( $cs_theme_options['cs_background_img'] ) && $cs_theme_options['cs_background_img'] !=''  ) { 
							$header_banner_image = $cs_theme_options['cs_background_img'];
						} else {
							$header_banner_image = "";
						}
						
						if ( isset( $cs_theme_options['cs_parallax_bg_switch'] ) && $cs_theme_options['cs_parallax_bg_switch'] !=''  ) { 
							$page_subheader_parallax = $cs_theme_options['cs_parallax_bg_switch'];
						} else {
							$page_subheader_parallax = "";
						}

					$page_subheader_color = (isset($cs_theme_options['cs_sub_header_bg_color']) and $cs_theme_options['cs_sub_header_bg_color']<>'' )?$cs_theme_options['cs_sub_header_bg_color']:'';
			$page_subheader_text_color = (isset($cs_theme_options['cs_sub_header_text_color']) and $cs_theme_options['cs_sub_header_text_color']<>'' )?$cs_theme_options['cs_sub_header_text_color']:'';
			
					if ( isset( $cs_theme_options['cs_background_img'] ) && $cs_theme_options['cs_background_img'] !=''  ) { 
						$header_banner_image = $cs_theme_options['cs_background_img'];
					} else {
						$header_banner_image = "";
					}
					
					if ( isset( $cs_theme_options['cs_parallax_bg_switch'] ) && $cs_theme_options['cs_parallax_bg_switch'] !=''  ) { 
						$page_subheader_parallax = $cs_theme_options['cs_parallax_bg_switch'];
					} else {
						$page_subheader_parallax = "";
					}
					
					//Padding Top & Bottom 
					if ( isset ( $cs_theme_options['subheader_padding_switch'] ) && $cs_theme_options['subheader_padding_switch'] == 'custom' ) {
						if ( empty( $cs_theme_options['cs_sh_paddingtop'] ) ) { $cs_sh_paddingtop = "";} else { $cs_sh_paddingtop = 'padding-top:'.$cs_theme_options['cs_sh_paddingtop'].'px;';}
						if ( empty( $cs_theme_options['cs_sh_paddingbottom'] ) ) { $cs_sh_paddingbottom = ""; } else { $cs_sh_paddingbottom = 'padding-bottom:'.$cs_theme_options['cs_sh_paddingbottom'].'px';}
					
					}
					//
				} else {
					if ( empty($cs_xmlObject->page_subheader_color) ) $page_subheader_color = ""; else $page_subheader_color = $cs_xmlObject->page_subheader_color;
					if ( empty($cs_xmlObject->page_subheader_text_color) ) $page_subheader_text_color = ""; else $page_subheader_text_color = $cs_xmlObject->page_subheader_text_color;
				
					if ( isset( $cs_xmlObject->page_subheader_no_image ) && $cs_xmlObject->page_subheader_no_image !=''  ) {  
					
						if ( empty($cs_xmlObject->header_banner_image) ) $header_banner_image = ""; else $header_banner_image = $cs_xmlObject->header_banner_image;
						if ( empty($cs_xmlObject->page_subheader_parallax) ) $page_subheader_parallax = ""; else $page_subheader_parallax = $cs_xmlObject->page_subheader_parallax;
					} else {
						$page_subheader_parallax = "";
						$header_banner_image     = "";
					}
					//Padding Top & Bottom 
					if ( isset ( $cs_xmlObject->subheader_padding_switch ) && $cs_xmlObject->subheader_padding_switch == 'custom' ) {
						if ( empty($cs_xmlObject->subheader_padding_top) ) { $cs_sh_paddingtop = "";} else { $cs_sh_paddingtop = 'padding-top:'.$cs_xmlObject->subheader_padding_top.'px;';}
						if ( empty($cs_xmlObject->subheader_padding_bottom) ) { $cs_sh_paddingbottom = ""; } else { $cs_sh_paddingbottom = 'padding-bottom:'.$cs_xmlObject->subheader_padding_bottom.'px';}
					
					}
				}
		}
		
		if ( $page_subheader_color ){
			$subheader_style_elements = 'background: '.$page_subheader_color.';';
		} else {
			$subheader_style_elements = '';
		}
		
 		if(isset($header_banner_image) && $header_banner_image !='') {
 			   
			$image_exsist = @fopen($header_banner_image, 'r');
		   if($image_exsist <> ''){
 				$banner_image_height = getimagesize($header_banner_image);				
		   }else{
			   $banner_image_height = '';	
		  	}
  			if($banner_image_height <> ''){
				$banner_image_height = $banner_image_height[1].'px';
			}
			if ( $page_subheader_parallax == 'on'){
				$parallaxStatus	= 'fixed';
			} else {
				$parallaxStatus	= '';
			}
	
			if ( $page_subheader_parallax == 'on'){
				$header_banner_image = 'url('.$header_banner_image.') center top '.$parallaxStatus.'';
				$subheader_style_elements = 'background: '.$header_banner_image.' '.$page_subheader_color.';';
			} else {
				$subheader_style_elements = '';
				$header_banner_image = 'url('.$header_banner_image.') center top '.$parallaxStatus.'';
				$subheader_style_elements = 'background: '.$header_banner_image.' '.$page_subheader_color.';';
			}
			
			$breadcrumSectionStart	= '<div class="absolute-sec">';
			$breadcrumSectionEnd	= '</div>';
		 }
		 $parallax_class = '';
		 $parallax_data_type = '';
		  if(isset($page_subheader_parallax) && (string)$page_subheader_parallax == 'on'){
			 echo '<script>jQuery(document).ready(function($){cs_parallax_func()});</script>';
			 $parallax_class = 'parallex-bg';
			 $parallax_data_type = ' data-type="background"';
		 }
		 if($subheader_style_elements){
			$subheader_style_elements = 'style="'.$subheader_style_elements.' ; '.$cs_sh_paddingtop.' '.$cs_sh_paddingbottom.'  "';	
		 } else {
		   $subheader_style_elements = 'style="min-height:'.$banner_image_height.'; '.$cs_sh_paddingtop.' '.$cs_sh_paddingbottom.' "';	
		 }
		
		?>
<div class="breadcrumb-sec <?php echo cs_allow_special_char($parallax_class);?>" <?php echo cs_allow_special_char($subheader_style_elements);?> <?php echo cs_allow_special_char($parallax_data_type);?>> 
  
  <!-- Container --> 
  <?php echo balanceTags($breadcrumSectionStart, false);?>
  <div class="container">
    <div class="cs-table">
      <div class="cs-tablerow"> 
        <!-- PageInfo -->
        <?php
			if(function_exists("is_shop") and is_shop()){
				$cs_shop_id = woocommerce_get_page_id( 'shop' );
				get_subheader_title($cs_shop_id);
			}else if(function_exists("is_shop") and !is_shop() and is_page()){
				get_subheader_title();
			}else if(is_page()){
					get_subheader_title();
			}else if(is_single() && $post_type != 'post'){
					get_subheader_title();
			}else if(is_single() && $post_type == 'post'){
					get_subheader_title();
			} else {
					get_default_post_title();
			}
		?>
        <!-- PageInfo -->
        <?php 
		   $page_tile_align = get_subheader_text_align();
		   
		   if ( $page_tile_align != 'page-title-align-center' ){
				get_subheader_breadcrumb();
		   }
		   ?>
      </div>
    </div>
  </div>
  <?php echo balanceTags($breadcrumSectionEnd, false);?> 
  <!-- Container --> 
</div>
<div class="clear"></div>
<?php
	}
}

/** 
 * @Page Sub header title and subtitle 
 *
 *
 */
if ( ! function_exists( 'get_subheader_breadcrumb' ) ) {
	function get_subheader_breadcrumb(){
	 global $post, $wp_query, $cs_theme_options, $cs_xmlObject;
	 
	$page_header_style = '';
	$page_bg_image = '';
	$page_subheader_text_color = '';
	if(is_page() || is_single()){
		$cs_post_type = get_post_type($post->ID);
		switch($cs_post_type){
			case 'sermons':
				$post_type_meta = 'sermons';
				break;
			case 'project':
				$post_type_meta = 'csprojects';
				break;
			case 'causes':
				$post_type_meta = 'cs_cause_meta';
				break;
			case 'events':
				$post_type_meta = 'events';
				break;
			default:
				$post_type_meta = 'cs_page_builder';
		}
		
		$cs_page_bulider = get_post_meta($post->ID, "$post_type_meta", true);
		$cs_xmlObject = new stdClass();
		if(isset($cs_page_bulider) && $cs_page_bulider <> ''){
			$cs_xmlObject = new SimpleXMLElement($cs_page_bulider);
			$page_header_style = $cs_xmlObject->header_banner_style;
			$page_bg_image = $cs_xmlObject->header_banner_image;
			$page_subheader_text_color = $cs_xmlObject->page_subheader_text_color;
		}
	}
		
	 if( ( isset($cs_xmlObject->page_breadcrumbs) && $cs_xmlObject->page_breadcrumbs == 'on' ) || ( isset($cs_theme_options['cs_breadcrumbs_switch']) && $cs_theme_options['cs_breadcrumbs_switch'] == 'on' ) ){?>
<!-- BreadCrumb -->
<div class="breadcrumb">
  <?php 
  
		 if ( is_author() || is_search() || is_archive() || is_category() ) {
			  if ( isset( $cs_theme_options['cs_sub_header_text_color'] ) &&  $cs_theme_options['cs_sub_header_text_color'] <> ''  ){ ?>
				<style scoped="scoped">
					.breadcrumb-sec, .breadcrumb ul li a,.breadcrumb ul li.active,.breadcrumb ul li:first-child:after {
						color : <?php echo cs_allow_special_char($cs_theme_options['cs_sub_header_text_color']);?> !important;
					}	
				</style>
  <?php  	   }
		 } else {
				 if ( isset($page_header_style) and $page_header_style == 'default_header' ) {
					if ( isset( $cs_theme_options['cs_sub_header_text_color'] ) &&  $cs_theme_options['cs_sub_header_text_color'] <> ''  ){ ?>
  					<style scoped="scoped">
						.breadcrumb-sec, .breadcrumb ul li a,.breadcrumb ul li.active,.breadcrumb ul li:first-child:after {
							color : <?php echo cs_allow_special_char($cs_theme_options['cs_sub_header_text_color']);?> !important;
						}	
					</style>
  <?php  			} 
  				 }
				 else if(isset($page_header_style) && $page_header_style == 'breadcrumb_header'){?>
                 
                 	<?php
					if(isset($page_bg_image) && $page_bg_image <> ''){
					?>
  					<style>
						.breadcrumb-sec {
							background:url('<?php echo cs_allow_special_char($page_bg_image); ?>');
						}	
						.breadcrumb-sec, .breadcrumb ul li a,.breadcrumb ul li.active,.breadcrumb ul li:first-child:after {
							color : <?php echo cs_allow_special_char($page_subheader_text_color);?> !important;
						}
					</style>
                    <?php 
					}
					?>
  <?php			}
				  else if(isset($page_subheader_text_color) && $page_subheader_text_color != ''){?>
  					<style>
						.breadcrumb-sec, .breadcrumb ul li a,.breadcrumb ul li.active,.breadcrumb ul li:first-child:after {
							color : <?php echo cs_allow_special_char($page_subheader_text_color);?> !important;
						}	
					</style>
  <?php			}
  		}?>
  <?php cs_breadcrumbs();?>
</div>
<!-- BreadCrumb -->
<?php }
                            
	}
}

/** 
 * @Page Sub header title and subtitle 
 *
 *
 */
if ( ! function_exists( 'get_subheader_text_align' ) ) {
	function get_subheader_text_align(){
		global $post, $cs_xmlObject,$cs_theme_options;
		
		$page_tile_align = '';
	    if ( isset($cs_xmlObject->header_banner_style) && $cs_xmlObject->header_banner_style == 'default_header' ) {
			
			if(isset($cs_theme_options['cs_title_align']) && $cs_theme_options['cs_title_align'] =='right'){
					$page_tile_align = 'page-title-align-right';
			}else if(isset($cs_theme_options['cs_title_align']) && $cs_theme_options['cs_title_align'] =='center'){
					$page_tile_align = 'page-title-align-center';
			}else {
					$page_tile_align = 'page-title-align-left';
			}
			
		} else {
			
			if(isset($cs_xmlObject->page_title_align) && $cs_xmlObject->page_title_align =='right'){
					$page_tile_align = 'page-title-align-right';
			}else if(isset($cs_xmlObject->page_title_align) && $cs_xmlObject->page_title_align =='center'){
					$page_tile_align = 'page-title-align-center';
			}else {
					$page_tile_align = 'page-title-align-left';
			}
		}
		
		return $page_tile_align;
	}
}

/** 
 * @Page Sub header title and subtitle 
 *
 *
 */
if ( ! function_exists( 'get_subheader_title' ) ) {
	function get_subheader_title($shop_id = ''){
		global $post, $cs_xmlObject,$cs_theme_options;
 		$page_tile_align = '';
	    $page_tile_align = get_subheader_text_align();
	
		if($shop_id <> ''){
			$post_ID = $shop_id;
		} else {
			$post_ID = $post->ID;
		}

		$text_color	= '';
		echo '<div class="pageinfo '.$page_tile_align.'" >';
				$color = '';	
				if ( isset($cs_xmlObject->header_banner_style) and $cs_xmlObject->header_banner_style == 'default_header' ) {
				
					if ( empty($cs_theme_options['cs_sub_header_text_color']) ) $text_color = ""; else $text_color = $cs_theme_options['cs_sub_header_text_color'];
				} else {
					if (isset($cs_xmlObject->page_subheader_text_color) and $cs_xmlObject->page_subheader_text_color <> ''){
							$text_color	= $cs_xmlObject->page_subheader_text_color;
					}
				}
				
				$color	= 'style="color:'.$text_color.' !important"';
 				if(isset($cs_xmlObject)){
					if(isset($cs_xmlObject->page_title) && $cs_xmlObject->page_title == 'on'){
						if(isset($cs_xmlObject->seosettings->cs_seo_title) && $cs_xmlObject->seosettings->cs_seo_title != ''){
							echo '<h1 '.$color.'>'.$cs_xmlObject->seosettings->cs_seo_title.'</h1>';	
						} else {
							if((isset($_GET['uid']) and $_GET['uid']) <> '' or (isset($cs_theme_option['cs_dashboard']) and $cs_theme_option['cs_dashboard'] == get_the_ID())){
								$tagline_text = '';
								$tagline_text = get_the_author_meta('tagline',$_GET['uid']);
								echo '<h1 '.$color.'>'.get_the_author_meta('display_name',$_GET['uid']).'</h1>';
								if($tagline_text <> ''){
									echo '<p>';
									echo balanceTags($tagline_text, false);
									echo '</p>';
								}
							}else{
								echo '<h1 '.$color.' class="test">';
								
								$post_type = get_post_type(get_the_ID());
									// If a News post, display "News & Updates" category description in place of title 
								if (is_page($post_ID)){
									// If Page
									echo get_the_title($post_ID);
								}
								else if($post_type == 'events'){
									// Is an Event
									echo "Events";
								}
								else {
									/* if a post */
									if (in_category('currentcampaigns') == true ){
										echo get_category_by_slug('currentcampaigns')->name;
									}
									else {
										echo "News & Updates"; //get_the_title($post_ID); 
									}
								}
								echo '</h1>';
							}
						}
					}
				} else {
					echo '<h1 '.$color.'>'.get_the_title($post_ID).'</h1>';
				}
				if(isset($cs_xmlObject->page_subheading_title) && $cs_xmlObject->page_subheading_title != ''){
					echo '<p '.$color.'>';
					echo do_shortcode($cs_xmlObject->page_subheading_title);
					echo '</p>';	
				}
				
				if ( $page_tile_align == 'page-title-align-center' ){
					get_subheader_breadcrumb();
				}
				
		echo '</div>';
	}
}
/** 
 * @ Default page title function
 *
 *
 */
if ( ! function_exists( 'get_default_post_title' ) ) {
	function get_default_post_title(){
		global $post,$cs_theme_options;
		$textAlign	=  $cs_theme_options['cs_title_align'];
		if ( empty($cs_theme_options['cs_sub_header_text_color']) ) $text_color = ""; else $text_color = 'style="color:'.$cs_theme_options['cs_sub_header_text_color'].'"';
		?>
		<div class="pageinfo <?php echo 'page-title-align-'.$textAlign;?>">
            <h1 <?php echo balanceTags($text_color, false);?>>
				<?php cs_post_page_title();?>
            </h1>
		</div>
		<?php 
	}
}
/** 
 * @ Default Main Menu
 *
 *
 */
function cs_main_navigation(){
	echo '<nav class="navigation">
          	<div class="navbar-default"><div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
        	</div></div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">';
				cs_header_main_navigation();
			echo '</div>
          </nav>';	
}
function cs_top_navigation(){
	//if(isset($cs_top_menu_switch) and $cs_top_menu_switch=='on'){
		
			echo '<div class="top-nav-wrapper">';				
				// CTA Top Nav
				echo '<nav class="top-nav">';
					cs_navigation('top-menu','','','1');
					if ( function_exists( 'cs_social_network' ) ) { cs_social_network(); }
				echo '</nav>';
			echo '</div>';
			
	//}
}
