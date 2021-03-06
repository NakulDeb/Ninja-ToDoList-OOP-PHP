<?php


namespace App\Controllers;


use App\Models\Post;

class Controller
{

    public function __construct()
    {
        //
    }



    
    public static function View($view, $parames = [])
    {
        $renderedLayout = self::renderLayout($parames);
        $renderedView =  self::renderView($view, $parames);
        return str_replace("@yield('content')", $renderedView, $renderedLayout);
    }




    protected static function renderLayout($parames)
    {
        ob_start();
        extract($parames);
        require_once __DIR__."/../../view/layouts/app.php";
        return ob_get_clean();
    }




    protected static function renderView($view, $parems)
    {
        ob_start();
        extract($parems);
        include_once __DIR__."/../../view/$view.php";;
        return ob_get_clean();
    }




    public static function back()
    {
        header("location: ".$_SESSION['REDIRECT_PATH']);
    }



    
    public static function string_sanitize($data)
    {
        $data = filter_var($data, FILTER_SANITIZE_STRING);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }



    public static function id_sanitize($id)
    {
        return filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    }





    protected static function methodMustBe(string $method = 'GET')
    {
        if($_SERVER['REQUEST_METHOD'] !== strtoupper($method)){
            echo '<pre>';
            print_r('POST method do not support Get Mothod...');
            exit();
        }
    }
}

