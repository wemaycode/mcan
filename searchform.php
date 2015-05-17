<?php 
/**
 * The template for displaying Search Form
 */
 global $cs_theme_options
?>
 

<div class="cs-search-area">
    <form  method="get" action="<?php echo home_url()?>"  role="search">
        <input name="s" placeholder="<?php  _e('Enter your search','Awaken');?>"  value="" type="text" />
        <label class="search-submit"><input id="searchsubmit" type="submit"></label>
    </form>
</div>