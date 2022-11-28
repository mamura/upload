<?php
namespace App\Core;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class Controller
{
    protected $container;
    protected $request;
    protected $response;
    protected $view;
    protected $em;
    protected $flash;

    public function __construct(ContainerInterface $container)
    {
        $this->container    = $container;
        $this->view         = $container->get('view');
        $this->em           = $container->get('em');
        $this->flash        = $container->get('flash');
    }

    public function render(Response $response, string $view) : Response
    {
        return $this->view->render($response, $view, []);
    }
}
