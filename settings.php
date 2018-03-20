<?php
$path = plugin_dir_path( __FILE__ ).'/zorgFacebook.php';
$data = get_plugin_data($path);
$message = ( get_option('facebook_id') ) ? get_option('facebook_id') : '';
$token = ( get_option('facebook_token') ) ? get_option('facebook_token') : '';
?>
<div class="wrapper">
    <p class="my_plugin_header"><?=$data['Name']?></p>
    <input class="my_message" placeholder="Enter id facebook group" value="<?=$message?>">
    <input class="my_token" placeholder="Enter token" value="<?=$token?>">
    <button id="my_plugin_save_button" class="button">Save settings</button>
</div>
