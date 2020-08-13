<?php

class MessagesController extends Controller
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
						'view'
				),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionView($id)
	{
			$this->pageTitle = 'Title - Message';
			$this->render('view',['id'=>$id]);
	}
	public function actionIndex()
	{
			$this->pageTitle = 'Title - Messages';
		  $this->render('index');
	}
}
