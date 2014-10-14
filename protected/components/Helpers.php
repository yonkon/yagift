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



} 