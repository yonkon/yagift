<?php

class ParsingController extends Controller
{
	public function actionIndex()
	{
//        $fromParsingResults = Product::fromParsingResults();
		$this->render('index');
	}

    public function actionSet_list_numbers() {
        $parsed_products = ParsingResults::selectProductsWithoutFilters();
        $listNum = 1;
        foreach($parsed_products as $pp) {
            /**
             * @var $product Product
             */
            $product = Product::model()->findByAttributes(array('name' => $pp['name']) );
            $product->ListNumber = $listNum++;
            $product->save();
        }
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