# Unicorn Farm
Api platform for guest book of Unicorn Farm 

## Technologies 

Technologies : 
- PHP 82
- Symfony Framework
- Doctrine ORM
- MySQl 
- Api platform (https://api-platform.com/)

## Install and start docker
    Please follow up the document 
    - https://docs.docker.com/get-docker/
## Build the container and run  the project
    - docker-compose  build
    - docker-compose up
## Access the PHP container
    docker exec -it unicorn-php82-container bash
## Install Vendor
    composer install
## Create Database
    php bin/console doctrine:database:create
## Create Tables
   php bin/console doctrine:migrations:migrate
## Load Initial Data
    php bin/console doctrine:fixtures:load
## Unit test
- Login to container(unicorn-php82-container)
- execute following command 
    - php bin/console doctrine:database:drop --env=test --force
    - php bin/console doctrine:database:create --env=test 
    - php bin/console doctrine:migrations:migrate --env=test
    - php bin/console doctrine:fixtures:load --env=test
    - php bin/phpunit
- Or execute ./phpunit.sh

## Symfony Local Server(For mail test)
    - symfony server:start

## Symfony Mail Catcher

symfony open:local:webmail
## Consuming Messages (Running the Worker)

symfony console messenger:consume async -vv

 - https://symfony.com/doc/current/messenger.html#consuming-messages-running-the-worker

##  To test purchase and email
    If you want to test email server in local please follow the following steps 
    - docker-compose up -d 
    -  cd <Project>/app
    -  symfony server:start -d
    -  Open mail catcher 
        symfony open:local:webmail
    - Mails are sending asynchronically. Please run following command to do 
     symfony console messenger:consume async -vv

    
