<?php
/**
 * Created by PhpStorm.
 * User: shikon
 * Date: 13.10.14
 * Time: 20:27
 */

class Helpers {

    public static function getContentUrl($url) {
    // From:http://coursesweb.net/php-mysql/// Seting options for cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/21.0 (compatible; MSIE 8.01; Windows NT5.0)');
        curl_setopt($ch, CURLOPT_TIMEOUT, 200);
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        curl_setopt($ch, CURLOPT_REFERER, 'http://google.com');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); // Follows redirect responses
        // gets the file content, trigger error if false
        $file = curl_exec($ch);
        if($file === false)
            trigger_error(curl_error($ch));
        curl_close ($ch);
        return $file;
    }

    public static function echoErrorSuccessFlashes() {
        if (Yii::app()->user->hasFlash('OK')) {
            echo '<div class="flash-success">' . Yii::app()->user->getFlash('OK')."<br /></div>";
        }
        if (Yii::app()->user->hasFlash('error')) {
            echo '<div class="flash-error">' . Yii::app()->user->getFlash('error')."<br /></div>";
        }
    }

    public static function echoBool($expression) {
        if(!empty($expression) && !!$expression) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public static function echoIfTrue($text, $condition = true) {
        if(!isset($text)) {
            $text = '';
        }
        if( $condition) {
            echo($text);
            return $text;
        }
        return false;
    }

    public static function returnJson ($answer) {
        if(empty($answer)) {
            die();
        }
        if(!is_array($answer)) {
            $answer = array('message' => $answer);
        }
        if(empty($answer['status'])) {
            $answer['status'] = 'OK';
        }
        echo json_encode($answer);
        die();
    }

    public static function secs_to_str($secs)
    {
        $units = array(
            "нед"   => 7*24*3600,
            "дн"    =>   24*3600,
            "ч"   =>      3600,
            "мин" =>        60,
            "сек" =>         1,
        );

        // specifically handle zero
        if ( $secs == 0 ) return "0 секунд";

        $s = "";

        foreach ( $units as $name => $divisor ) {
            if ( $quot = intval($secs / $divisor) ) {
                $s .= "$quot $name";
                $s .= /*(abs($quot) > 1 ? "s" : "") . */  ", ";
                $secs -= $quot * $divisor;
            }
        }

        return substr($s, 0, -2);
    }

  public static function filters2title($filters) {
    $result = Yii::t('seo', 'gifts');
    $parts = array('day' => '', 'for' => '', 'button' => '', 'age' => '');
    $parts_translated = array();
    foreach($filters as $filter) {
      $param_name = $filter['param']->param_name;
      $param_type = $filter['param']->param_type;
      $param_description = $filter['param']->param_description;
      $param_value = $filter['value'];
      if(in_array($param_type, Helpers::$filtersInTitle)) {
        $parts[$param_type] = $param_description;
      }
    }
    $parts['day'] =  empty($parts['day']) ? '' :  Yii::t('seo', $parts['day']);
    if(!empty ($parts['button']) ) {
      $parts['for'] .= ' ' . $parts['button'];
    }
    $parts['for'] = trim($parts['for']);
    $parts['for'] =  empty($parts['for']) ? '' :  Yii::t('seo', $parts['for']);
    $parts['age'] =  empty($parts['age']) ? '' :  Yii::t('seo', $parts['age']);
    if (!empty($parts['day']) )  {
      $parts['day'] = trim($parts['day']);
      if (!empty($parts['day']) )  {
        $parts_translated[] = $parts['day'];
      }
    }
    if (!empty($parts['for'])  ) {
      $parts['for'] = trim($parts['for']);
      if (!empty($parts['for'])  ) {
        $parts_translated[] = $parts['for'];
      }
    }
    if (!empty($parts['age'])  ) {
      $parts['age']= trim($parts['age']);
      if (!empty($parts['age'])  ) {
        $parts_translated[] = $parts['age'];
      }
    }
    $parts_translated = join(': ', $parts_translated);
    return $result . ' ' . $parts_translated;
  }

  public static $filtersInTitle = array(
    'day', 'button', 'for', 'age'
  );

} 