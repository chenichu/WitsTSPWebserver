<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class TestForm extends CFormModel
{
	public $data;
	public $result;
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'data'=>'Data',
		);
	}
}