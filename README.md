# Setup

Put the folder in a place so that one can visit it by using the url
http://localhost/etc. E.g. putting in int /var/www (if that is the web root).

# Tests

```
curl -sS https://getcomposer.org/installer | php
./composer.phar install
curl -O https://selenium-release.storage.googleapis.com/2.53/selenium-server-standalone-2.53.0.jar
```
See [php-webdriver](https://github.com/facebook/php-webdriver) for more information.

First start the selenium selenium-server which is used when running frontend
tests

```
java -jar selenium-server-standalone-2.53.0.jar
```

Run all test:

```
vendor/bin/phpunit
```

Only run backend tests:

```
vendor/bin/phpunit --group backend
```
