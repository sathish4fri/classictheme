<?php
$user = elgg_get_page_owner_entity();
$profile_cover = ClassicTheme::coverUrl($user->guid);
if(ClassicTheme::isCover($user->guid)){
  $cover = '<div ><img src="'.$profile_cover.'" z-index="-1" height="200px" width="100%"/></div>';
} 
else {
  $cover = '';       	
}
?>
<script>
$(document).ready(function() {
      $("#coveformbutton").fancybox();
});
</script>
<?php echo $cover;?>
<div class="profile elgg-col-2of3">
	<div class="elgg-inner clearfix">
		<?php echo elgg_view('profile/owner_block'); ?>
		<?php echo elgg_view('profile/details'); ?>
	</div>
</div>

<div style="display:none;">
 <div id="coveform">
   <form action="<?php echo elgg_get_site_url();?>action/addcover" method="post" enctype="multipart/form-data">
   <?php echo elgg_view('input/securitytoken'); ?>
   <input type="file" name="ohyes_cover" />
   <input type="submit" class="elgg-button elgg-button-submit" />
   <?Php 
   	if(ClassicTheme::isCover(elgg_get_logged_in_user_entity()->guid)){
   	$url = elgg_add_action_tokens_to_url("action/deletecover");
    echo '<a href="'.$url.'" class="elgg-button elgg-button-submit">Remove</a>';
	}
	
 ?>
   </form>
   
    </div>
</div>