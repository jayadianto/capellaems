<?php
Yii::import('zii.widgets.CPortlet');
class DataPopUp extends CPortlet
{
	public $Prefix; //Prefix untuk model, misalkan: Province_
	public $ColField; //Textbox untuk menerima return teks 
	public $IDField; //ID untuk menerima return integer
	public $IsRequired = false; //jika required, maka tanda * akan tampil
	public $model;
	public $IDDialog;
	public $titledialog;
	public $form;
	public $PopUpName;
	public $PopGrid;
	public $poptype = 'horizontal';
	public $classtype = 'col-sm-3';
	public $classtypebox = 'col-sm-3';
	public $onclicksign;
	public $onaftersign;


	protected function renderContent()
	{
		$this->render($this->PopUpName,array(
			'model'=>$this->model
		));
	}
}