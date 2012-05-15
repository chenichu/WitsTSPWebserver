<?php
/**
 * DistanceForm class.
 * DistanceForm is the data structure for keeping
 * Distance form data. It is used by the 'distance' action of 'SiteController'.
 */

class DistanceForm extends CFormModel
{
	//public varaibles goes here
	public $originsA; 
	public $destinationsA;
	
	public $originsString;
	public $destinationsString;
	public $distMatrix;
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
				array('originsA','required'),
				array('originsA','validateInput','pattern'=>'/^([\n]?[0-9 ]+)$/m'),
				//array('originsA','squareMatrixCheck'),
				array('destinationsA','required'),
				array('destinationsA','validateInput','pattern'=>'/^([\n]?[0-9 ]+)$/m'),
				//array('destinationsA','squareMatrixCheck'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'originsA'=>'OriginsA',
				//'destinationsA'=>'DestinationsA',
		);
	}

	public function validateInput($attribute,$params)
	{
		//$test = trim($this->$attribute, "\n");
		if (!preg_match($params['pattern'], $this->$attribute))
			$this->addError('originsA','Incorrect Data!');
		/*if (!preg_match($params['pattern'], $this->$attribute))
			$this->addError('destinationsA','Incorrect Data!');*/
	}

	public function modifyData()
	{
		//var_dump($this->data);
		$this->formatted_data = preg_replace('!\s+!', ' ', $this->originsA);
		//$this->formatted_data2 = preg_replace('!\s+!', ' ', $this->destinationsA);
		//var_dump($this->formatted_data);
	}

	public function squareMatrixCheck()
	{
		$formatted_data_array = explode(" ", $this->formatted_data);
		//$formatted_data_array2 = explode(" ", $this->formatted_data2);
		//var_dump($formatted_data_array);
		$square_size = pow((int)$formatted_data_array[0],2);
		if (count($formatted_data_array) != $square_size+1)
			$this->addError('originsA','Cities are not a square matrix!');
	}
}