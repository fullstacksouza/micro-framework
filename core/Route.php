<?php


namespace Core;

class Route
{
    private $routes;

    public function __construct(array $routes)
    {
        $this->setRoutes($routes);
        $this->run();
    }
    public function getUrl()
    {

        return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        
    }
    private  function setRoutes($routes)
    {

        foreach($routes as $route)
        {

            $explode = explode('@',$route[1]);
            $r = [$route[0],$explode[0],$explode[1]];
            
            $newRoutes[] = $r;
           
        }
        $this->routes = $newRoutes;
        return $r;
    }
    private function run()
    {
        $url =  $this->getUrl();
        $urlArray = explode('/',$url);
        $param[] = [];
        if(is_array($this->routes) || is_object($this->routes))
        {
            foreach($this->routes as $route)
            {
                $routeArray = explode('/',$route[0]);
            
                //verificando se a rota possui parametros
                for($i=0;$i< count($routeArray);$i++)
                {
                    //verificando se contem "{ na url
                    if(strpos($routeArray[$i],"{")!==false && (count($urlArray)== count($routeArray)))
                        {
                            $routeArray[$i] = $urlArray[$i];
                            $param          = $urlArray[$i];
                        }
                    $route[0] = implode($routeArray,'/');
                }

                print_r($route[0]);

                
                if($url == $route[0])
                {
                    $found      = true;
                    $controller = $route[1];
                    $action     = $route[2];
                    break;
                }else{
                    throw new \Exception("Rota nao encontrada");
                }

            }
            //se a rota foi encontrada
            if($found)
            {
                $newController = Container::newController($controller);
                switch(count($param))
                {
                    case 1:
                        $newController->$action($param[0]);
                        break;
                    case 2:
                        $newController->$action($param[0],$param[1]);
                        break;
                    case 1:
                        $newController->$action($param[0],$param[1],$param[2]);
                        break;
                    default:
                        $newController->$action();

                }    
            }
        }
        

    }
}