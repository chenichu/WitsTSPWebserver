<?php 
	$siteName = "The Travellers";
	$this->pageTitle= $siteName; 
?>


<h1>Welcome to <i><?php echo CHtml::encode($siteName); ?></i></h1>

<p>Congratulations! You are wise to use this application to make your everyday travel, a walk in the park.</p>

<?php if (Yii::app()->user->getName()=== 'admin') : ?>

<p> To view/change/modify Users on TSP database, click <a href="../ayiitest/index.php?r=user">here</a> </p>
		

<?php endif; ?> 
<!-- $image = Yii::app()-> image->load('images/van.jpg');
$image->resize(400, 100)->rotate(-45)->quality(75)->sharpen(20);
$image->render(); -->

<!-- <p align="center"> <img src="images/DHL.jpg" alt="Service Delivery" align="middle" border="1" />
<img src="images/tspMan.jpg" alt="Service Delivery" align="middle" border="1" /> </p>  -->


<p> To view and use normal map services, please visit
<a href="http://maps.google.co.za">Google Maps</a>
</p>
