<?php
/**
 * @var $app CWebApplication
 */
$app = Yii::app();
if ($app->user->isGuest) {
    $app->request->redirect($app->createUrl(
            '/site/login',
            array(
                'returnUrl'=> $app->request->getUrl()
            )
        )
    );
}

$app->clientScript->registerCssFile('../css/admin.css');
$app->clientScript->registerScriptFile('../js/admin.js', CClientScript::POS_END);

class AdminController extends Controller
{
	public function actionIndex()
	{
        $processedFilter = ProductValues::processFilter($_REQUEST);
        $criteria = ProductValues::getFilterCriteria($processedFilter);
        if(!empty($_REQUEST['PriceMin']) ) {
            $pmin = preg_replace('/[^\d]/', '', $_REQUEST['PriceMin']);
            $criteria->addCondition('price >= ' . $pmin );
        }
        if(!empty($_REQUEST['PriceMax']) ) {
            $pmax = preg_replace('/[^\d]/', '', $_REQUEST['PriceMax']);
            $criteria->addCondition('price <= ' . $pmax );
        }
        $criteria->order = 'url ASC, ListNumber ASC';
        $count=Product::model()->count($criteria);
        $pages=new CPagination($count);
// элементов на страницу
        $pages->pageSize=20;
        $pages->applyLimit($criteria);
        $products = Product::model()->findAll($criteria);
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index', array('pages' => $pages, 'products' => $products));
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