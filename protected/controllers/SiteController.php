<?php

class SiteController extends Controller
{
  public $defaultAction = 'list';
  /**
   * Declares class-based actions.
   */
  public function actions()
  {
    return array(
      // captcha action renders the CAPTCHA image displayed on the contact page
      'captcha' => array(
        'class' => 'CCaptchaAction',
        'backColor' => 0xFFFFFF,
      ),
      // page action renders "static" pages stored under 'protected/views/site/pages'
      // They can be accessed via: index.php?r=site/page&view=FileName
      'page' => array(
        'class' => 'CViewAction',
      ),
    );
  }

  /**
   * This is the default 'index' action that is invoked
   * when an action is not explicitly requested by users.
   */
  public function actionIndex()
  {
    // renders the view file 'protected/views/site/index.php'
    // using the default layout 'protected/views/layouts/main.php'
    $this->render('index');
  }

  public function actionList()
  {
    $processedFilter = ProductValues::processFilter($_REQUEST);
    $title = Helpers::filters2title($processedFilter);
    $this->pageTitle = $title;
    $criteria = ProductValues::getFilterCriteria($processedFilter);
    if (!empty($_REQUEST['PriceMin'])) {
      $pmin = preg_replace('/[^\d]/', '', $_REQUEST['PriceMin']);
      $criteria->addCondition('price >= ' . $pmin);
    }
    if (!empty($_REQUEST['PriceMax'])) {
      $pmax = preg_replace('/[^\d]/', '', $_REQUEST['PriceMax']);
      $criteria->addCondition('price <= ' . $pmax);
    }
    $criteria->order = 'ListNumber ASC';
    $count = Product::model()->count($criteria);
    $pages = new CPagination($count);
// элементов на страницу
    $pages->pageSize = 20;
    $pages->applyLimit($criteria);

    $products = Product::model()->findAll($criteria);
    // renders the view file 'protected/views/site/index.php'
    // using the default layout 'protected/views/layouts/main.php'
    $this->render('list', array('pages' => $pages, 'products' => $products));
  }

  /**
   * This is the action to handle external exceptions.
   */
  public function actionError()
  {
    if ($error = Yii::app()->errorHandler->error) {
      if (Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else
        $this->render('error', $error);
    }
  }

  /**
   * Displays the contact page
   */
  public function actionContact()
  {
    $model = new ContactForm;
    if (isset($_POST['ContactForm'])) {
      $model->attributes = $_POST['ContactForm'];
      if ($model->validate()) {
        $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
        $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
        $headers = "From: $name <{$model->email}>\r\n" .
          "Reply-To: {$model->email}\r\n" .
          "MIME-Version: 1.0\r\n" .
          "Content-Type: text/plain; charset=UTF-8";

        mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
        Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
        $this->refresh();
      }
    }
    $this->render('contact', array('model' => $model));
  }

  /**
   * Displays the login page
   */
  public function actionLogin()
  {
    $model = new LoginForm;

    // if it is ajax validation request
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }

    // collect user input data
    if (isset($_POST['LoginForm'])) {
      $model->attributes = $_POST['LoginForm'];
      // validate user input and redirect to the previous page if valid
      if ($model->validate() && $model->login()) {
        if (!empty($_REQUEST['returnUrl'])) {
          $this->redirect($_REQUEST['returnUrl']);
        } else {
          $this->redirect(Yii::app()->user->returnUrl);
        }
      }
    }
    // display the login form
    $this->render('login', array('model' => $model));
  }

  /**
   * Logs out the current user and redirect to homepage.
   */
  public function actionLogout()
  {
    Yii::app()->user->logout();
    $this->redirect(Yii::app()->homeUrl);
  }

  public function actionImage_rewrite($id = null)
  {
//    return false;
    if (empty ($id)) {
      $products = Product::model()->findAll();
//      $products = Product::model()->findAllBySql('SELECT * from ' . Product::tableName() . ' WHERE image NOT LIKE "%' . Yii::app()->createAbsoluteUrl(Yii::app()->getHomeUrl()) . '%" ');
      /**
       * @var $product Product
       */
      foreach ($products as $product) {
        if (!$product->hasLocalImage()) {
          $product->makeLocalImage();
        }
//                $image_url = preg_replace('/size=\d/', 'size=6', $product->image);
//                $image_bin = Helpers::getContentUrl($image_url);
//                $dirimg = realpath(Yii::app()->basePath . '/../images') . '/' . $product->product_id. '/'; // directory in which the image will be saved
//                $filename = preg_replace('/.*path=(.*)&.*/', '$1', $image_url);
//                $image_new_url = Yii::app()->createAbsoluteUrl('images/' . $product->product_id. '/' . $filename);
//                if(!is_dir($dirimg)) {
//                    mkdir($dirimg);
//                    chmod($dirimg, 0777);
//                }
//                $localfile = $dirimg . $filename;
//                file_put_contents($localfile, $image_bin);
//                if (is_file($localfile) && filesize($localfile)) {
//                    $product->image = $image_new_url;
//                    $product->save();
//                    $minified = new SimpleImage();
//                    $minified->load($localfile);
//                    $minified->resizeToHeight(100);
//                    $minified->save(preg_replace('/(.*)\.(.*)/', '$1.min.$2', $localfile));
//                }
//                $img_resource =  curl_init($image_url);
//
//                curl_close($img_resource);
      }

    }
  }


}