<?php

$app = Yii::app();

/**
 * Class PagesController
 */
class PagesController extends Controller
{
	public function actionContacts()
	{
		$this->render('contacts');
	}

	public function actionHelp()
	{
		$this->render('help');
	}

	public function actionPayment()
	{
		$this->render('payment');
	}

  public function beforeAction($action) {
    Helpers::registerAnalytics();
    Helpers::useConfigMetas();
    return parent::beforeAction($action);
  }

  public function beforeRender($view, &$data = null) {
    $data['meta'] = Helpers::getConfigMetas();
    return parent::beforeRender($view, $data);
  }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}