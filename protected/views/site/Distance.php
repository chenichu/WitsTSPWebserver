<?php
$this->pageTitle=Yii::app()->name . ' - Calculate Route';
$this->breadcrumbs=array(
	'Distance',
);
?>

<h1>Route Calculation</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'distance-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	),
)); ?>

	<p class="note">Enter the Origin.</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Origins:'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'originsA'); ?>
	</div>
	
	<p class="note">Enter the Destinations.</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Destinations:'); ?>
		<?php echo $form->textArea($model,'destinationsA',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'destinationsA'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->
