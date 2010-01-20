<?php
/*
Plugin Name: Running Line
Plugin URI: http://rubensargsyan.com/wordpress-plugin-running-line/
Description: This plugin shows one of the posts from your chosen category by the running line. <a href="options-general.php?page=running-line.php">Settings</a>
Version: 1.1
Author: Ruben Sargsyan
Author URI: http://rubensargsyan.com/
*/

/*  Copyright 2009 Ruben Sargsyan (email: info@rubensargsyan.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$running_line_plugin_url = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
$running_line_plugin_title = "Running Line";
$running_line_plugin_prefix = "rnngln_";
$running_line_version = "1.1";

function install_running_line(){
    $running_line_plugin_prefix = "rnngln_";
    $running_line_version = "1.1";

    set_default_running_line_settings();

    add_option($running_line_plugin_prefix."version",$running_line_version);
}

function set_running_line_settings($running_line_settings){
    $running_line_plugin_prefix = "rnngln_";

    add_option($running_line_plugin_prefix."settings",$running_line_settings);
}

function set_default_running_line_settings(){
    $running_line_plugin_prefix = "rnngln_";

    $running_line_category = get_option("default_category");
    $running_line_order = "rand";
    $running_line_position = "bottom";
    $running_line_direction = "left";
    $running_line_scrolldelay = 85;
    $running_line_height = "20px";
    $running_line_font_size = "15px";
    $running_line_color = "#000000";
    $running_line_border_size = "1px";
    $running_line_border_color = "#000000";
    $running_line_background = "#ffffff";
    $running_line_padding = "5px";

    $running_line_settings = array($running_line_plugin_prefix."category"=>$running_line_category,$running_line_plugin_prefix."order"=>$running_line_order,$running_line_plugin_prefix."position"=>$running_line_position,$running_line_plugin_prefix."direction"=>$running_line_direction,$running_line_plugin_prefix."scrolldelay"=>$running_line_scrolldelay,$running_line_plugin_prefix."width"=>$running_line_width,$running_line_plugin_prefix."height"=>$running_line_height,$running_line_plugin_prefix."font_size"=>$running_line_font_size,$running_line_plugin_prefix."color"=>$running_line_color,$running_line_plugin_prefix."border_size"=>$running_line_border_size,$running_line_plugin_prefix."border_color"=>$running_line_border_color,$running_line_plugin_prefix."background"=>$running_line_background,$running_line_plugin_prefix."padding"=>$running_line_padding);

    set_running_line_settings($running_line_settings);
}

function update_running_line_settings($running_line_settings){
    global $running_line_plugin_prefix;

    $current_running_line_settings = get_running_line_settings();

    $running_line_settings = array_merge($current_running_line_settings,$running_line_settings);

    update_option($running_line_plugin_prefix."settings",$running_line_settings);
}

function get_running_line_settings(){
    global $running_line_plugin_prefix;

    $running_line_settings = get_option($running_line_plugin_prefix."settings");

    return $running_line_settings;
}

function running_line_menu(){
    if(function_exists('add_options_page')){
        add_options_page('Running Line','Running Line', 'manage_options', basename(__FILE__), 'running_line_admin') ;
    }
}

function running_line_admin(){
    global $running_line_plugin_url, $running_line_plugin_title, $running_line_plugin_prefix;
    ?>
    <script src="<?php echo($running_line_plugin_url.'javascript/jscolor.js'); ?>" type="text/javascript"></script>
    <?php

    if($_GET["page"]==basename(__FILE__)){
        if($_POST["action"]=="save"){
            $running_line_category = intval($_POST[$running_line_plugin_prefix."category"]);
            if(trim(strip_tags($_POST[$running_line_plugin_prefix."order"]))=="rand"){
                $running_line_order = "rand";
            }else{
                $running_line_order = "desc";
            }
            if(trim(strip_tags($_POST[$running_line_plugin_prefix."direction"]))=="right"){
                $running_line_direction = "right";
            }else{
                $running_line_direction = "left";
            }
            if(trim(strip_tags($_POST[$running_line_plugin_prefix."position"]))=="top"){
                $running_line_position = "top";
            }else{
                $running_line_position = "bottom";
            }
            $running_line_scrolldelay = intval($_POST[$running_line_plugin_prefix."scrolldelay"]);
            $running_line_height = trim(strip_tags($_POST[$running_line_plugin_prefix."height"]));
            $running_line_font_size = trim(strip_tags($_POST[$running_line_plugin_prefix."font_size"]));
            $running_line_color = "#".trim(strip_tags(substr($_POST[$running_line_plugin_prefix."color"],0,6)));
            $running_line_border_size = trim(strip_tags($_POST[$running_line_plugin_prefix."border_size"]));
            $running_line_border_color = "#".trim(strip_tags(substr($_POST[$running_line_plugin_prefix."border_color"],0,6)));
            $running_line_background = "#".trim(strip_tags(substr($_POST[$running_line_plugin_prefix."background"],0,6)));
            $running_line_padding = trim(strip_tags($_POST[$running_line_plugin_prefix."padding"]));

            $running_line_settings = array($running_line_plugin_prefix."category"=>$running_line_category,$running_line_plugin_prefix."order"=>$running_line_order,$running_line_plugin_prefix."direction"=>$running_line_direction,$running_line_plugin_prefix."position"=>$running_line_position,$running_line_plugin_prefix."scrolldelay"=>$running_line_scrolldelay,$running_line_plugin_prefix."width"=>$running_line_width,$running_line_plugin_prefix."height"=>$running_line_height,$running_line_plugin_prefix."font_size"=>$running_line_font_size,$running_line_plugin_prefix."color"=>$running_line_color,$running_line_plugin_prefix."border_size"=>$running_line_border_size,$running_line_plugin_prefix."border_color"=>$running_line_border_color,$running_line_plugin_prefix."background"=>$running_line_background,$running_line_plugin_prefix."padding"=>$running_line_padding);

            foreach($running_line_settings as $running_line_option => $running_line_option_value){
                if(empty($running_line_option_value)){
                    unset($running_line_settings[$running_line_option]);
                }
            }

            update_running_line_settings($running_line_settings);

            echo('<div id="message" class="updated fade"><p><strong>'.$running_line_plugin_title.' Settings Saved.</strong></p></div>');
        }elseif($_POST["action"]=="reset"){
            delete_option($running_line_plugin_prefix."settings");

            echo('<div id="message" class="updated fade"><p><strong>'.$running_line_plugin_title.' Settings Reset.</strong></p></div>');
        }
    }

    if(get_running_line_settings()===false){
        set_default_running_line_settings();
    }

    $running_line_settings = get_running_line_settings();

    ?>
    <div class="wrap">
      <h2><?php echo $running_line_plugin_title; ?> Settings</h2>

      <form method="post">
        <table width="100%" border="0" id="running_line_settings_table">
          <tr>
            <td width="20%" rowspan="2" valign="middle"><strong>Select Category</strong></td>
            <td width="80%">
                <select name="<?php echo($running_line_plugin_prefix); ?>category" id="<?php echo($running_line_plugin_prefix); ?>category" style="width:250px;">
                    <?php
                      $categories = get_categories("hide_empty=0");
                      foreach($categories as $category){
                        ?>
                        <option value="<?php echo($category->cat_ID); ?>"<?php if($category->cat_ID==$running_line_settings[$running_line_plugin_prefix."category"]){ echo(' selected="selected"'); } ?>><?php echo($category->cat_name); ?></option>
                        <?php
                      }
                     ?>
                </select>
            </td>
          </tr>
          <tr>
            <td><small>Select the category the post of which you wish to be appeared in the running line.</small></td>
          </tr>
          <tr>
            <td width="20%" rowspan="2" valign="middle"><strong>Select Order Type</strong></td>
            <td width="80%">
                <label for="<?php echo($running_line_plugin_prefix); ?>rand" style="cursor: pointer">Rand</label> <input type="radio" name="<?php echo($running_line_plugin_prefix); ?>order" id="<?php echo($running_line_plugin_prefix); ?>rand"<?php if($running_line_settings[$running_line_plugin_prefix."order"]=="rand"){ echo(' checked="checked"'); } ?> value="rand" /> <label for="<?php echo($running_line_plugin_prefix); ?>desc" style="cursor: pointer">DESC</label> <input type="radio" name="<?php echo($running_line_plugin_prefix); ?>order" id="<?php echo($running_line_plugin_prefix); ?>desc"<?php if($running_line_settings[$running_line_plugin_prefix."order"]=="desc"){ echo(' checked="checked"'); } ?> value="desc" />
            </td>
          </tr>
          <tr>
            <td><small>Select order type of chosen category posts.</small></td>
          </tr>
          <tr>
            <td width="20%" rowspan="2" valign="middle"><strong>Select The Direction</strong></td>
            <td width="80%">
                <label for="<?php echo($running_line_plugin_prefix); ?>left" style="cursor: pointer">Left</label> <input type="radio" name="<?php echo($running_line_plugin_prefix); ?>direction" id="<?php echo($running_line_plugin_prefix); ?>left"<?php if($running_line_settings[$running_line_plugin_prefix."direction"]=="left"){ echo(' checked="checked"'); } ?> value="left" /> <label for="<?php echo($running_line_plugin_prefix); ?>right" style="cursor: pointer">Right</label> <input type="radio" name="<?php echo($running_line_plugin_prefix); ?>direction" id="<?php echo($running_line_plugin_prefix); ?>right"<?php if($running_line_settings[$running_line_plugin_prefix."direction"]=="right"){ echo(' checked="checked"'); } ?> value="right" />
            </td>
          </tr>
          <tr>
            <td><small>Select the direction of the running line. Option left indicates that the text starts at the right and moves leftwards across the page. Option right indicates that the text starts at the left and moves rightwards across the page.</small></td>
          </tr>
          <tr>
            <td width="20%" rowspan="2" valign="middle"><strong>Select The Position</strong></td>
            <td width="80%">
                <label for="<?php echo($running_line_plugin_prefix); ?>bottom" style="cursor: pointer">Bottom</label> <input type="radio" name="<?php echo($running_line_plugin_prefix); ?>position" id="<?php echo($running_line_plugin_prefix); ?>bottom"<?php if($running_line_settings[$running_line_plugin_prefix."position"]=="bottom"){ echo(' checked="checked"'); } ?> value="bottom" /> <label for="<?php echo($running_line_plugin_prefix); ?>top" style="cursor: pointer">Top</label> <input type="radio" name="<?php echo($running_line_plugin_prefix); ?>position" id="<?php echo($running_line_plugin_prefix); ?>top"<?php if($running_line_settings[$running_line_plugin_prefix."position"]=="top"){ echo(' checked="checked"'); } ?> value="top" />
            </td>
          </tr>
          <tr>
            <td><small>Select the position of the running line.</small></td>
          </tr>
          <tr>
            <td width="20%" rowspan="2" valign="middle"><strong>Set Running Line Speed</strong></td>
            <td width="80%">
                <input name="<?php echo($running_line_plugin_prefix); ?>scrolldelay" id="<?php echo($running_line_plugin_prefix); ?>scrolldelay" type="text" style="width:100px;" value="<?php echo($running_line_settings[$running_line_plugin_prefix."scrolldelay"]); ?>" />
            </td>
          </tr>
          <tr>
            <td><small>This option sets the speed of the running line.</small></td>
          </tr>

          <tr>
            <td width="20%" rowspan="2" valign="middle"><strong>Set Running Line Height</strong></td>
            <td width="80%">
                <input name="<?php echo($running_line_plugin_prefix); ?>height" id="<?php echo($running_line_plugin_prefix); ?>height" type="text" style="width:100px;" value="<?php echo($running_line_settings[$running_line_plugin_prefix."height"]); ?>" />
            </td>
          </tr>
          <tr>
            <td><small>This option sets the height (Example: 20px, 10pt, 5em, 2% ... ) of the running line.</small></td>
          </tr>
          <tr>
            <td width="20%" rowspan="2" valign="middle"><strong>Set Font Size</strong></td>
            <td width="80%">
                <input name="<?php echo($running_line_plugin_prefix); ?>font_size" id="<?php echo($running_line_plugin_prefix); ?>font_size" type="text" style="width:100px;" value="<?php echo($running_line_settings[$running_line_plugin_prefix."font_size"]); ?>" />
            </td>
          </tr>
          <tr>
            <td><small>This option sets the font size (Example: 15px, 10pt, 5em, 10% ... ) of the running line text.</small></td>
          </tr>
          <tr>
            <td width="20%" rowspan="2" valign="middle"><strong>Set Running Line Text Color</strong></td>
            <td width="80%">
                <input autocomplete="off" class="color" name="<?php echo($running_line_plugin_prefix); ?>color" id="<?php echo($running_line_plugin_prefix); ?>color" type="text" style="width:100px;" value="<?php echo($running_line_settings[$running_line_plugin_prefix."color"]); ?>" />
            </td>
          </tr>
          <tr>
            <td><small>Click on the text field to set another color.</small></td>
          </tr>
          <tr>
            <td width="20%" rowspan="2" valign="middle"><strong>Set Running Line Border Size</strong></td>
            <td width="80%">
                <input name="<?php echo($running_line_plugin_prefix); ?>border_size" id="<?php echo($running_line_plugin_prefix); ?>border_size" type="text" style="width:100px;" value="<?php echo($running_line_settings[$running_line_plugin_prefix."border_size"]); ?>" />
            </td>
          </tr>
          <tr>
            <td><small>This option sets the border size (Example: 1px, 0.8pt, 0.2em ... ) of the running line.</small></td>
          </tr>
          <tr>
            <td width="20%" rowspan="2" valign="middle"><strong>Set Running Line Border Color</strong></td>
            <td width="80%">
                <input autocomplete="off" class="color" name="<?php echo($running_line_plugin_prefix); ?>border_color" id="<?php echo($running_line_plugin_prefix); ?>border_color" type="text" style="width:100px;" value="<?php echo($running_line_settings[$running_line_plugin_prefix."border_color"]); ?>" />
            </td>
          </tr>
          <tr>
            <td><small>Click on the text field to set another color.</small></td>
          </tr>
          <tr>
            <td width="20%" rowspan="2" valign="middle"><strong>Set Running Line Background Color</strong></td>
            <td width="80%">
                <input autocomplete="off" class="color" name="<?php echo($running_line_plugin_prefix); ?>background" id="<?php echo($running_line_plugin_prefix); ?>background" type="text" style="width:100px;" value="<?php echo($running_line_settings[$running_line_plugin_prefix."background"]); ?>" />
            </td>
          </tr>
          <tr>
            <td><small>Click on the text field to set another color.</small></td>
          </tr>
          <tr>
            <td width="20%" rowspan="2" valign="middle"><strong>Set Running Line Padding</strong></td>
            <td width="80%">
                <input name="<?php echo($running_line_plugin_prefix); ?>padding" id="<?php echo($running_line_plugin_prefix); ?>padding" type="text" style="width:100px;" value="<?php echo($running_line_settings[$running_line_plugin_prefix."padding"]); ?>" />
            </td>
          </tr>
          <tr>
            <td><small>This option sets the running line text padding (Example: 5px, 2pt, 0.5em ... ) from borders.</small></td>
          </tr>
          <tr>
            <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table>
        <p class="submit">
          <input name="save" type="submit" value="Save changes" />
          <input type="hidden" name="action" value="save" />
        </p>
      </form>
      <form method="post">
        <p class="submit">
          <input name="reset" type="submit" value="Reset" />
          <input type="hidden" name="action" value="reset" />
        </p>
      </form>
    </div>
    <?php
}

function running_line_style(){
    global $running_line_plugin_url;
?>
    <link rel="stylesheet" href="<?php echo($running_line_plugin_url); ?>css/running-line-style.php" type="text/css" />
    <!--[if IE 6]>
        <link rel="stylesheet" href="<?php echo($running_line_plugin_url); ?>css/running-line-iestyle.php" type="text/css" />
    <![endif]-->
<?php
}

function running_line(){
    global $running_line_plugin_prefix;

    $running_line_settings = get_running_line_settings();

    $category = $running_line_settings[$running_line_plugin_prefix."category"];
    $order = $running_line_settings[$running_line_plugin_prefix."order"];

    $marquee_string = "";

    if($order == "desc"){
      $args = "numberposts=1&category=".$category."&order=desc";
    }else{
      $args = "numberposts=1&category=".$category."&orderby=rand";
    }

    $posts = get_posts($args);
    foreach($posts as $post){
        $marquee_string .= trim(strip_tags($post->post_content));
    }
?>
    <div id="running_line" class="running_line">
      <marquee behavior="scroll" direction="<?php echo($running_line_settings[$running_line_plugin_prefix."direction"]); ?>" scrolldelay=<?php echo($running_line_settings[$running_line_plugin_prefix."scrolldelay"]); ?>>
          <?php echo($marquee_string); ?>
      </marquee>
    </div>
<?php
}

register_activation_hook(__FILE__,'install_running_line');
add_action('admin_menu', 'running_line_menu');
add_action('wp_head', 'running_line_style');
add_action('wp_footer', 'running_line');
?>