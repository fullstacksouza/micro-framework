<?php
$route[] = ['/','HomeController@index'];
$route[] = ['/{1}','HomeController@index'];
$route[] = ['/user/{id}/show','HomeController@show'];

return $route;