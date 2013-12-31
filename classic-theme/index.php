<?php
if (elgg_is_logged_in()) forward('/activity/');
?>


<html lang="en">
    <head>
      <link rel="stylesheet" type="text/css" href="mod/classic-theme/css/style.css" />
       </head>
 <body>
		<div>
	<img src="mod/classic-theme/graphics/index.jpg" width=80% alt="Background"/>
	<div class="ac_overlay"></div>
			<div class="ac_loading"></div>
		</div><div class="topright">
  <?php include("mod/classic-theme/form.php"); ?>

</div>
		
			
		
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="mod/classic-theme/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript">
			$(function() {
				var $ac_background	= $('#ac_background'),
				$ac_bgimage		= $ac_background.find('.ac_bgimage'),
				$ac_loading		= $ac_background.find('.ac_loading'),
				
				$ac_content		= $('#ac_content'),
				$title			= $ac_content.find('h1'),
				$menu			= $ac_content.find('.ac_menu'),
				$mainNav		= $menu.find('ul:first'),
				$menuItems		= $mainNav.children('li'),
				totalItems		= $menuItems.length,
				$ItemImages		= new Array();
				
				$menuItems.each(function(i) {
					$ItemImages.push($(this).children('a:first').attr('href'));
				});
				$ItemImages.push($ac_bgimage.attr('src'));
					  
				
				var Menu 			= (function(){
					var init				= function() {
						loadPage();
						initWindowEvent();
					},
					loadPage			= function() {
						
						$ac_loading.show();
						$.when(loadImages()).done(function(){
							$.when(showBGImage()).done(function(){
								
								$ac_loading.hide();
								$.when(slideOutMenu()).done(function(){
										$.when(toggleMenuItems('up')).done(function(){
										initEventsSubMenu();
									});
								});
							});
						});
					},
					showBGImage			= function() {
						return $.Deferred(
						function(dfd) {
							
							adjustImageSize($ac_bgimage);
							$ac_bgimage.fadeIn(1000, dfd.resolve);
						}
					).promise();
					},
					slideOutMenu		= function() {
					
						var new_w	= $(window).width() - $title.outerWidth(true);
						return $.Deferred(
						function(dfd) {
							
							$menu.stop()
							.animate({
								width	: new_w + 'px'
							}, 700, dfd.resolve);
						}
					).promise();
					},
						
						toggleMenuItems		= function(dir) {
						return $.Deferred(
						function(dfd) {
							
							$menuItems.each(function(i) {
										var $el_title	= $(this).children('a:first'),
											marginTop, opacity, easing;
										if(dir === 'up'){
											marginTop	= '0px';
											opacity		= 1;
											easing		= 'easeOutBack';
										}
										else if(dir === 'down'){
											marginTop	= '60px';
											opacity		= 0;
											easing		= 'easeInBack';
						}
								$el_title.stop()
								.animate({
													marginTop	: marginTop,
													opacity		: opacity
												 }, 200 + i * 200 , easing, function(){
									if(i === totalItems - 1)
										dfd.resolve();
								});
							});
						}
					).promise();
					},
					initEventsSubMenu	= function() {
						$menuItems.each(function(i) {
							var $item		= $(this), // the <li>
							$el_title	= $item.children('a:first'),
							el_image	= $el_title.attr('href'),
							$sub_menu	= $item.find('.ac_subitem'),
							$ac_close	= $sub_menu.find('.ac_close');
							
						
							$el_title.bind('click.Menu', function(e) {
									$.when(toggleMenuItems('down')).done(function(){
									openSubMenu($item, $sub_menu, el_image);
								});
								return false;
							});
							
							$ac_close.bind('click.Menu', function(e) {
								closeSubMenu($sub_menu);
								return false;
							});
						});
					},
					openSubMenu			= function($item, $sub_menu, el_image) {
						$sub_menu.stop()
						.animate({
							height		: '400px',
							marginTop	: '-200px'
						}, 400, function() {
										
							showItemImage(el_image);
						});
					},
					
					showItemImage		= function(source) {
						
						if($ac_bgimage.attr('src') === source)
							return false;
								
						var $itemImage = $('<img src="'+source+'" alt="Background" class="ac_bgimage"/>');
						$itemImage.insertBefore($ac_bgimage);
						adjustImageSize($itemImage);
						$ac_bgimage.fadeOut(1500, function() {
							$(this).remove();
							$ac_bgimage = $itemImage;
						});
						$itemImage.fadeIn(1500);
					},
					closeSubMenu		= function($sub_menu) {
						$sub_menu.stop()
						.animate({
							height		: '0px',
							marginTop	: '0px'
						}, 400, function() {
							
										toggleMenuItems('up');
						});
					},
						
					initWindowEvent		= function() {
							$(window).bind('resize.Menu' , function(e) {
							adjustImageSize($ac_bgimage);
								var new_w	= $(window).width() - $title.outerWidth(true);
							$menu.css('width', new_w + 'px');
						});
					},
							adjustImageSize		= function($img) {
						var w_w	= $(window).width(),
						w_h	= $(window).height(),
						r_w	= w_h / w_w,
						i_w	= $img.width(),
						i_h	= $img.height(),
						r_i	= i_h / i_w,
						new_w,new_h,
						new_left,new_top;
							
						if(r_w > r_i){
							new_h	= w_h;
							new_w	= w_h / r_i;
						}
						else{
							new_h	= w_w * r_i;
							new_w	= w_w;
						}
							
						$img.css({
							width	: new_w + 'px',
							height	: new_h + 'px',
							left	: (w_w - new_w) / 2 + 'px',
							top		: (w_h - new_h) / 2 + 'px'
						});
					},
						
					loadImages			= function() {
						return $.Deferred(
						function(dfd) {
							var total_images 	= $ItemImages.length,
							loaded			= 0;
							for(var i = 0; i < total_images; ++i){
								$('<img/>').load(function() {
									++loaded;
									if(loaded === total_images)
										dfd.resolve();
								}).attr('src' , $ItemImages[i]);
							}
						}
					).promise();
					};
						
					return {
						init : init
					};
				})();
			
			
				Menu.init();
			});
		</script>
		
		
		<script type="text/javascript">
$(document).ready(function () {
	$('.messages').animate({opacity: 1.0}, 1000);
	$('.messages').animate({opacity: 1.0}, 5000);
	$('.messages').fadeOut('slow');

	$('span.closeMessages a').click(function () {
		$(".messages").stop();
		$('.messages').fadeOut('slow');
	return false;
	});

	$('div.messages').click(function () {
		$(".messages").stop();
		$('.messages').fadeOut('slow');
	return false;
	});
});
</script>
<script type="text/javascript">
$(document).ready(function () {
	$('.messages_error').animate({opacity: 1.0}, 1000);
	$('.messages_error').animate({opacity: 1.0}, 5000);
	$('.messages_error').fadeOut('slow');

	$('span.closeMessages a').click(function () {
		$(".messages_error").stop();
		$('.messages_error').fadeOut('slow');
	return false;
	});

	$('div.messages').click(function () {
		$(".messages").stop();
		$('.messages').fadeOut('slow');
	return false;
	});
});
</script>
    </body>
</html>