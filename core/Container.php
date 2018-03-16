<?php
namespace Core;

class Container
{
    public static function newController($controller)
    {
        $objController = "App\\Controllers\\".$controller;
        return new $objController;
    }
}