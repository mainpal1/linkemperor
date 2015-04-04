<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo 'Login'?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('main','bootstrap','bootstrap-responsive','jquery-ui-1.8.22.custom'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<style type="text/css">
      body {
      	margin : 0;
      	padding : 0;
        background-color: #f5f5f5;
        padding-top : 40px;
      }
      .form-signin {
      	max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
        margin-top: 110px;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
      	margin-bottom: 0px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-top: 15px;
        margin-bottom: 0px;
        padding: 7px 9px;
      }
      .form-signin select{
      	margin-top : 15px;
      	margin-bottom: 15px;
      }
    </style>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#">Fault Finder</a>
			</div>
		</div>
	</div>
	<div class="container">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</div>
	<!-- Placed at the end of the document so the pages load faster -->
	<?php
		echo $this->Html->script(array('jquery-1.7.2.min','jquery-ui-1.8.22.custom.min','bootstrap.min'));
	?>
</body>
</html>
