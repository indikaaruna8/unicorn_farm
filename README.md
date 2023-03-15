# unicorn_farm

## Technologies 

Technologies : 
- PHP 82
- Symfony Framework
- Doctrine ORM
- MySQl 
- Api platform (https://api-platform.com/)

## Access the PHP container
    docker exec -it unicorn-php82-container bash
## Load test data
    php bin/console doctrine:fixtures:load
## Unit test
- Login to container(unicorn-php82-container)
- execute following command 
    php bin/console doctrine:database:drop --env=test --force
    php bin/console doctrine:database:create --env=test 
    php bin/console doctrine:migrations:migrate --env=test
    php bin/console doctrine:fixtures:load --env=test
    php bin/phpunit
- Or execute ./phpunit.sh
