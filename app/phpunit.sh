php bin/console doctrine:database:drop --env=test --force
php bin/console doctrine:database:create --env=test 
php bin/console doctrine:migrations:migrate --env=test
php bin/console doctrine:fixtures:load --env=test
php bin/phpunit