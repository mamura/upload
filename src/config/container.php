<?php

use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Slim\Flash\Messages;
use Slim\Views\Twig;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

return [
    'settings' => function () {
        return require __DIR__ . 'settings.php';
    },

    'view' => function (ContainerInterface $container) {
        $view = Twig::create(__DIR__ . '/../views', ['cache' => false]);

        $env = $view->getEnvironment();
        $env->addGlobal('messages', $container->get('flash')->getMessages());
        $env->addGlobal('session', $_SESSION);
        
        return $view;
    },

    'em' => function () {
        return EntityManager::create(
            [
                'driver' => 'pdo_sqlite',
                'path'      => '/src/data/db.sqlite'
            ],
            Setup::createAttributeMetadataConfiguration(
                ['/src/app/Models/Entity'],
                true,
                null,
                DoctrineProvider::wrap(new ArrayAdapter())
            )
        );
    },

    'flash' => function () {
        return new Messages();
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    }
];
