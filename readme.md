# Working with Value Objects in PHP

These are the files used in my talk "Working with Value Objects in PHP".

## Requirements

- PHP 7.4+

## Using Docker

You can use [Docker](https://docker.com) to run the examples in this project, for example:

```bash
docker run --rm --volume $(pwd):/files --workdir /files  php:7.4-cli-alpine php samples/auto-validation.php

Fatal error: Uncaught InvalidArgumentException: JPY isn't a valid currency. in /files/samples/auto-validation.php:13
Stack trace:
#0 /files/samples/auto-validation.php(34): Price->__construct('JPY', 199.99)
#1 {main}
  thrown in /files/samples/auto-validation.php on line 13
```
