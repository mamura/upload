<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

return [
    'settings' => function () {
        return require __DIR__ . 'settings.php';
    },

    'view' => function (ContainerInterface $container) {
        return Twig::create(__DIR__ . '/../views', ['cache' => false]);
    },

    'em' => function () {
        return EntityManager::create(
            [
                'driver' => 'pdo_sqlite',
                'path'      => __DIR__ . '/../data/db.sqlite'
            ],
            Setup::createAnnotationMetadataConfiguration([
                __DIR__ . '/../app/Models/Entity'
            ]),
            true
        );
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    }
];
