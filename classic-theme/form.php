<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<title>Twitter Login</title>
<link href="mod/classic-theme/front.css" media="screen, projection" rel="stylesheet" type="text/css">
</head>
<body>

  <div id="topnav" class="topnav" style="font-size:18px; font-weight:bold;"> Have an account? <a href="login" class="signin"><span>Sign in</span></a> </div>
  &nbsp;
  <fieldset id="signin_menu" style="font-size:16px;">
    <?php
								$form_body = "<p><label>" . elgg_echo('username') . "<br />" . elgg_view('input/text', array('internalname' => 'username', 'class' => 'login-textarea')) . "</label><br />";
								$form_body .= "<label>" . elgg_echo('password') . "<br />" . elgg_view('input/password', array('internalname' => 'password', 'class' => 'login-textarea')) . "</label><br />";
								$form_body .= elgg_view('input/submit', array('value' => elgg_echo('login'))) . "</p>";
								$form_body .= "<p><a href=\"". $vars['url'] ."register\">" . elgg_echo('register') . "</a> | <a href=\"". $vars['url'] ."forgotpassword\">" . elgg_echo('user:password:lost') . "</a></p>";

								echo elgg_view('input/form', array('body' => $form_body, 'action' => "". $vars['url'] ."action/login"));

					  ?>
    </form>
  </fieldset>

<script src="mod/classic-theme/javascripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function() {

            $(".signin").click(function(e) {          
				e.preventDefault();
                $("fieldset#signin_menu").toggle();
				$(".signin").toggleClass("menu-open");
            });
			
			$("fieldset#signin_menu").mouseup(function() {
				return false
			});
			$(document).mouseup(function(e) {
				if($(e.target).parent("a.signin").length==0) {
					$(".signin").removeClass("menu-open");
					$("fieldset#signin_menu").hide();
				}
			});			
			
        });
</script>
<script src="mod/classic-theme/javascripts/jquery.tipsy.js" type="text/javascript"></script>
<script type='text/javascript'>
    $(function() {
	  $('#forgot_username_link').tipsy({gravity: 'w'});   
    });
  </script>
</body>
</html>