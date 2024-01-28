# GQL-PDSS Skeleton

## Instalar

    composer create-project wappcode/gql-pdss-skeleton


Crear archivo config/doctrine.local.php con la configuración de la base de datos

    <?php
    return [
        "driver" => [
            'user'     =>   '',
            'password' =>   '',
            'driver'   =>   'pdo_mysql',
            'host'   =>     '127.0.0.1',
            'dbname'   =>   '',
            'charset' =>    'utf8mb4'
        ],
        "entities" => require __DIR__ . "/doctrine.entities.php"
    ];

Iniciar API con el comándo

    php -S localhost:8000 public/index.php

Para consultar API Graphql la ruta es http://localhost:8000/api


