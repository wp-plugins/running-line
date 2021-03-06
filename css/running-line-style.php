<?php
header("content-type: text/css");
$path  = '';

if(!defined('WP_LOAD_PATH')){
	$root = dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/';

	if(file_exists($root.'wp-load.php')){
        define('WP_LOAD_PATH',$root);
	}else{
        if(file_exists($path.'wp-load.php')){
            define('WP_LOAD_PATH',$path);
        }else{
            exit("Cannot find wp-load.php");
        }
	}
}

require_once(WP_LOAD_PATH.'wp-load.php');

global $wpdb;

$running_line_plugin_prefix = "rnngln_";
$running_line_settings = get_option($running_line_plugin_prefix."settings");
?>
#running_line{
    width: 100%;
    position: fixed;
    <?php echo($running_line_settings[$running_line_plugin_prefix."position"]); ?>: 0px;
    height: <?php echo($running_line_settings[$running_line_plugin_prefix."height"]); ?>;
    padding: <?php echo($running_line_settings[$running_line_plugin_prefix."padding"]); ?>;
    background: <?php echo($running_line_settings[$running_line_plugin_prefix."background"]); ?>;
    font-size: <?php echo($running_line_settings[$running_line_plugin_prefix."font_size"]); ?>;
    color: <?php echo($running_line_settings[$running_line_plugin_prefix."color"]); ?>;
    border-top: <?php echo($running_line_settings[$running_line_plugin_prefix."border_size"]); ?> solid <?php echo($running_line_settings[$running_line_plugin_prefix."border_color"]); ?>;
    border-bottom: <?php echo($running_line_settings[$running_line_plugin_prefix."border_size"]); ?> solid <?php echo($running_line_settings[$running_line_plugin_prefix."border_color"]); ?>;
    cursor: pointer;
    }

marquee{
    border: none;
}