<?php 
/*
Plugin Name: News Ticker
Plugin URI: http://prowpexpert.com/
Description: This plugin will enable news tickr in your wordpress theme. You can embed news tickr via shortcode in everywhere you want, even in theme files. 
Author: news Persons
Version: 1.1
Author URI: paisleyfarmersmarket.ca/sohels/
*/


/*Some Set-up*/
define('WP_MS_NEWS_TICKER_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

function ms_news_tickr_latest_jquery() {
/**
 * Register global styles & scripts.
 */
wp_register_style('news-news-css', WP_MS_NEWS_TICKER_PLUGIN_PATH.'css/ticker-style.css');
wp_register_style('news-style-css', WP_MS_NEWS_TICKER_PLUGIN_PATH.'css/style.css');

wp_register_script('news-news-js', WP_MS_NEWS_TICKER_PLUGIN_PATH.'js/jquery.ticker.js', array( 'jquery' ));


/**
 * Enqueue global styles & scripts.
 */
 
wp_enqueue_style('news-news-css');
wp_enqueue_style('news-style-css');

wp_enqueue_script('news-news-js');
wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'ms_news_tickr_latest_jquery' );




function tickr_list_shortcode($atts){
	extract( shortcode_atts( array(
		'category' => '',
		'count' => '5',
		'category_slug' => 'category_ID',
		'text' => 'Latest News',
	), $atts, 'projects' ) );
	
    $q = new WP_Query(
        array('posts_per_page' => $count, 'post_type' => 'post', $category_slug => $category)
        );		
		
		
	$list = '<div class="breakingNews">
	<ul id="js-news" class="js-hidden">';
	while($q->have_posts()) : $q->the_post();
		$idd = get_the_ID();
		$list .= '
		
			<li class="news-item"><a href="'.get_permalink().'">'.get_the_title().'</a></li>
			
		';        
	endwhile;
	$list.= '</ul>
	<div class="bn-navi">
        	<span></span>
            <span></span>
        </div>
	</div>';
	wp_reset_query();
	return $list;
}
add_shortcode('tickr_list', 'tickr_list_shortcode');





function add_news_jquery_active_in_head() {
?>
	<script type="text/javascript">
		jQuery(function () {
			jQuery('#js-news').ticker();
		});	
	</script>
	
<?php
}
add_action('wp_head', 'add_news_jquery_active_in_head');








?>