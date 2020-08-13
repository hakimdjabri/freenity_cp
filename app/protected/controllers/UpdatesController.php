<?php

class UpdatesController extends Controller
{
	public $layout = 'admin';
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(
						'index',
						'message'
				),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{
			$this->pageTitle = 'Title - Updates';
		  $this->render('index');
	}
	public function actionMessage($id)
	{
			$this->pageTitle = 'Title - Updates';
			$this->render('message',['id'=>$id]);
	}
}
