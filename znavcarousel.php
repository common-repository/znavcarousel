<?php
/*
Plugin Name: zNavCarousel
Plugin URI: http://wp-skins.info/2009/01/13/moy-otvet-chimberlenu-ili-novaya-postranichnaya-razbivka-stranits.html
Description: Супер-пупер постраничная навигация, для вставки в шаблон используйте <strong>&lt;?php znavcarousel(); ?&gt;</strong>
Author: Truper
Version: 1.0.1
Author URI: http://wp-skins.info/
*/
 
function zheader() {
	$nc_path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	$zcur=intval(get_query_var('paged'))-4;
	$hHead = "\n"."<!-- Start NavCarousel -->\n";
	$hHead .= "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js\"></script>\n";
	$hHead .= "<link rel=\"stylesheet\" href=\"".$nc_path."znavcarousel.css\" type=\"text/css\" media=\"screen\" />\n";
	$hHead .= "<script language=\"javascript\" type=\"text/javascript\" src=\"".$nc_path."znavcarousel.js\" ></script>\n";
	$hHead .= "<script type=\"text/javascript\">jQuery(document).ready(function(){ jQuery('#mycarousel').jcarousel({visible:10,scroll:9,start:".$zcur."}); });</script>\n";
	$hHead .= "<!-- End NavCarousel -->\n";
	print($hHead);
}

add_action('wp_head', 'zheader');

function znavcarousel($wth){
	if (!isset($wth)) {$wth=600;}
	if (!is_single() and !is_page()){
		global $wp_query;
		$max_page = $wp_query->max_num_pages;
		if($max_page!=1){
			$paged = intval(get_query_var('paged'));
			echo "<style type=\"text/css\" media=\"all\">/* <![CDATA[ */\n";
			echo ".jcarousel-skin-tango .jcarousel-container-horizontal {width:".$wth."px;}\n";
			echo ".jcarousel-skin-tango .jcarousel-clip-horizontal {width:".($wth-90)."px;}\n";
			echo "/* ]]> */</style>\n";
			echo '<div id="wrap"><ul id="mycarousel" class="jcarousel-skin-tango">';
			$curpage=1;
			while ($curpage<=$max_page){
				if ($curpage==$paged or ($paged==0 and $curpage==1)){
					echo '<li style="font-weight: bolder;">'.$curpage.'</li>';
				}else{
					echo '<li><a href="'.get_pagenum_link($curpage).'">'.$curpage.'</a></li>';
				}
				$curpage=$curpage+1;
			}
			echo '</ul></div>';
		}
	}
}
?>