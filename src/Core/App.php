<?php

namespace Core;

use Core\Container\Container;
use Model\Model;
use PDO;
use Request\Request;
use Service\LoggerService;
use Throwable;


class App
{
    private array $routes = [];

    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function get(string $url, string $class, string $handler, string $request = null): void
    {
        $this->routes[$url]['GET'] = [
            'class' => $class,
            'method' => $handler,
            'request' => $request
        ];
    }

    public function post(string $url, string $class, string $handler, string $request = null): void
    {
        $this->routes[$url]['POST'] = [
            'class' => $class,
            'method' => $handler,
            'request' => $request
        ];
    }

    public function bootstrap(): void
    {
        $pdo = $this->container->get(PDO::class);
        Model::initialize($pdo);
    }

    public function run(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$requestUri])) {
            $routeMethods = $this->routes[$requestUri];
            if (isset($routeMethods[$requestMethod])) {
                $this->bootstrap();

                $handler = $routeMethods[$requestMethod];
                $class = $handler['class'];
                $method = $handler['method'];
                $request = $handler['request'];

                $obj = $this->container->get($class);

                if (isset($request)) {
                    $request = new $handler['request']($requestMethod, $requestUri, headers_list(), $_REQUEST);
                } else {
                    $request = new Request($requestMethod, $requestUri, headers_list(), $_REQUEST);
                }

                try {
                    $response = $obj->$method($request);

                    if (is_array($response) && isset($response['view'])) {
                        $view = $response['view'];
                        $params = $response['params'] ?? [];

                        extract($params);

                        require_once "./../View/$view";
                    } else {
                        echo json_encode($response);
                    }
                } catch (Throwable $exception) {
                    LoggerService::error($exception);

                    require_once './../View/500.html';
                }

            } else {
                echo "Метод $requestMethod не поддерживается для адреса $requestUri";
            }
        } else {
            require_once './../View/404.html';
        }
    }
}
