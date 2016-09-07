#!/bin/sh
ROOT="/site"

docker run -v $(pwd):$ROOT --rm delete21/phpunit:5.5 --bootstrap $ROOT/config/autoload.php $ROOT/tests