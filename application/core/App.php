<?php
/**
 * Created by PhpStorm.
 * User: NoteBook
 * Date: 22.11.2018
 * Time: 10:49
 */

namespace app\core;


use app\controllers\BlogController;
use app\controllers\SiteController;

class App
{
    public  static function run(){
        $routes = include __DIR__.'/../routes.php';
        $url = $_SERVER['REQUEST_URI'];
        foreach ($routes as $pattern => $route){
            preg_match($pattern, $url,$matches);
            if(!empty($matches)){
                break;  // останаливаем проверку если есть совпадение
            }
        }
        foreach ($matches as $key =>$value){
            if(is_int($key)){
                unset($matches[$key]);
            }
        }
        $pageId =  $matches['id']; // Id страницы, полученная из параметра в регулярном выражении
        $tmp = explode('@', $route);
        $control = 'app\controllers\\'.$tmp[0];
        $controller = new $control;
        $method = $tmp[1];
        $controller ->$method();
    }
}