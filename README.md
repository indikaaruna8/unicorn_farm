# Unicorn Farm
Api platform for guest book of Unicorn Farm 

## Technologies 

Technologies : 
- PHP 82
- Symfony Framework
- Doctrine ORM
- MySQl 
- Api platform (https://api-platform.com/)

# Structure 
  - app : Symfony project
  - mysql: mysql database files 
  - nginx : nginx configurations  
  - php : php, composer, symfony installation instruction 
    
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

    
## How to use api's:

- I should be able to get a list of all the unicorns at the farm
    ````
    ```
    - curl -X 'GET'  'http://localhost:8081/api/unicorns?page=1&order%5Bname%5D=desc' -H 'accept: application/json'
    ```
    ````
- I should be able to create a post in my name
    Two api call's requied 
    - Create Unicorn Enthusiast
    ````
    ```
        curl -X 'POST' \
        'http://localhost:8081/api/unicorn_enthusiasts' \
        -H 'accept: application/ld+json' \
        -H 'Content-Type: application/ld+json' \
        -d '{
        "name": "Mike",
        "email": "mike@abc.com"
        }'
    ```
    ````
        <br />
    ````
    ```
        You will get following output <br />
        {
            "@context": "/api/contexts/UnicornEnthusiast",
            "@id": "/api/unicorn_enthusiasts/9",
            "@type": "UnicornEnthusiast",
            "name": "Mike",
            "email": "mike@abc.com",
            "post": []
        }
    ````
    ```
    - Create a post 
        ````
        ```
            curl -X 'POST' \
            'http://localhost:8081/api/posts' \
            -H 'accept: application/ld+json' \
            -H 'Content-Type: application/ld+json' \
            -d '{
            "message": "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet ",
            "unicorn": "/api/unicorns/206",
            "unicornEnthusiast": "/api/unicorn_enthusiasts/9"
            }'
        ```
        ````
            - /api/unicorns/206 : Unicorn get api uri 
            - /api/unicorn_enthusiasts/9 -  Unicorn Enthusiast get api 
         
    - I should be able to link a new (or existing) post to my favourite unicorn
        - you can use POST/PUT/PATCH api with  "unicorn": "/api/unicorns/[[UNICORN_ID]])",
    - I should be able to fix a typo I made in my post
        - You can use PUT/PATCH Api 
    - I should be able to see all posts that were made
        _ You can seach post by email.
        ````
        ``` 
            curl -X 'GET' \
            'http://localhost:8081/api/posts?page=1&unicornEnthusiast.email=mike%40abc.com' \
            -H 'accept: application/ld+json'
        ```
        ````

    - I should be able to see all posts someone specific has made
        ````
        ```
            curl -X 'GET' \
                'http://localhost:8081/api/posts?page=1&unicornEnthusiast.email=mike%40abc.com' \
                -H 'accept: application/ld+json'
        ```
    ````
    - I should be able to delete a post I made
        - Get all the post that you created
        - Delete post one by one
        ````
        ```
            curl -X 'DELETE' \
            'http://localhost:8081/api/posts/14' \
            -H 'accept: */*'
        ```
        ````

    - I should be able to purchase a unicorn, which should delete all posts linked to my
        unicorn
        ````
        ```
            curl -X 'POST' \
            'http://localhost:8081/api/purchase' \
            -H 'accept: application/ld+json' \
            -H 'Content-Type: application/ld+json' \
            -d '{
            "unicorn": " /api/unicorns/206 ",
            "unicornEnthusiasts": "/api/unicorn_enthusiasts/9"
            }'
        ```
        ````
        Api will delete the post send mail as synchronically