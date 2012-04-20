<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class TestForm extends CFormModel
{
	public $data;
	public $formatted_data;
	public $result;
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
		array('data','required'),
		//array('data','numerical'),
		array('data','validateInput','pattern'=>'/^([\n]?[0-9 ]+)$/m'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'data'=>'Data',
		);
	}

	public function validateInput($attribute,$params)
	{
		//$test = trim($this->$attribute, "\n");
		if (!preg_match($params['pattern'], $this->$attribute))
			$this->addError('data','Incorrect Data!');
	}
	
	public function modifyData()
	{
		//var_dump($this->data);
		$this->formatted_data = preg_replace('!\s+!', ' ', $this->data);
		//var_dump($this->formatted_data);
	} 

}
