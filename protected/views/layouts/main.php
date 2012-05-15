<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo "The Travellers (Plan Your Route Today!)"; ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php 
		if (Yii::app()->user->getName()=== 'admin')
		{
			$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Test', 'url'=>array('/site/test')),
				array('label'=>'Route Planning', 'url'=>array('site/page', 'view'=>'rawDistance')),
				//array('label'=>'Route Planning', 'url'=>array('/site/Distance')),
				array('url'=>array('/site/page', 'view'=>'googlemaps'), 'label'=>'Distance Matrix'),
				array('url'=>array('/site/page', 'view'=>'about'), 'label'=>'About'),
				array('label'=>'Contact Us', 'url'=>array('/site/contact')),
				array('url'=>array('/user', 'view'=>'user'), 'label'=>'Admin Tasks'),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); 
		}
		else 
		{
			$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Test', 'url'=>array('/site/test')),
				//array('label'=>'Route Planning', 'url'=>array('/site/Distance')),
				array('label'=>'Route Planning', 'url'=>array('site/page', 'view'=>'rawDistance')),
				array('url'=>array('/site/page', 'view'=>'googlemaps'), 'label'=>'Distance Matrix'),
				array('url'=>array('/site/page', 'view'=>'about'), 'label'=>'About'),
				array('label'=>'Contact Us', 'url'=>array('/site/contact')),
				array('url'=>array('/user/create', 'view'=>'create'), 'label'=>'Register'),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); 

		}
			?>
	</div><!-- mainmenu -->
	<?php //if(isset($this->breadcrumbs)):?>
	<?php if(false):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by The Travellers C.C.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
