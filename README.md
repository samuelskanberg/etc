# Setup

```
curl -sS https://getcomposer.org/installer | php
./composer.phar install
curl -O https://selenium-release.storage.googleapis.com/2.53/selenium-server-standalone-2.53.0.jar
```
See [php-webdriver](https://github.com/facebook/php-webdriver) for more information.

# Tests

First start the selenium selenium-server which is used when running frontend
tests

```
java -jar selenium-server-standalone-2.53.0.jar
```

Run all test:

```
vendor/bin/phpunit
```
