#!/bin/bash

php /home/commands/init-database.php;
rm /var/www/html/composer.lock;
composer install --no-interaction
vendor/bin/doctrine orm:schema-tool:update --force
apache2-foreground
