<?php
/**
 * @var $app CWebApplication
 */
$app = Yii::app();
if ($app->user->isGuest) {
    throw new CHttpException(403,'Forbidden! Need authorisation.');
}

class AjaxController extends Controller
{
	public function actionProduct()
	{
        if(empty($_REQUEST['id'])){
            throw new CHttpException(404, 'No product ID provided');
        }
        $id = $_REQUEST['id'];
        unset($_REQUEST['id']);
        $this->checkAjax();
        $product = Product::model()->findByPk($id);
        /**
         * @var $product Product
         */
        if(empty($product)) {
            throw new CHttpException(404, 'Product not found');
        }
        $errors = array();
        foreach($_REQUEST as $field => $value) {
            if ($product->hasAttribute($field)) {
                $product->$field = $value;
            } else {
                $errors[] = "Поля $field в классе models/Product не существует.";
            }
        }
        if ($product->validate()) {
            if($product->save()) {
                $message = Yii::t('general', 'Update successful');
                Helpers::returnJson(
                    array(
                        'data' => array(
                            'message' => $message,
                            'errors' => $errors
                        )
                    )
                );
            }
        }
        $message = Yii::t('general', 'Update failed');
        Helpers::returnJson(
            array(
                'status' => 'Error',
                'data' => array(
                    'message' => $message,
                    'errors' => $errors
                )
            )
        );
//		$this->render('product');
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

    public static function checkAjax() {
        if($_REQUEST['ajax'] != 'ajax') {
            throw new CHttpException(403,'Forbidden for public use');
        }
        unset ($_REQUEST['ajax']);
    }

}