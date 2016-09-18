#!/bin/bash

# GLOBAL VARIABLES
ROOT="/app"

# COMMAND LINE VARIABLES
COMMAND=$1

# DOCKER FUNCTIONS

run_test(){
	docker run --rm \
		-v "$(pwd)":$ROOT \
		alpine-phpunit:3.3 --stderr --bootstrap $ROOT/tfatf/autoload.php $ROOT/tests
}

build_images(){
	docker build -t alpine-phpunit:3.3 .
}

# MENU
case "$COMMAND" in
	-t) run_test; ;;
	-b) build_images; ;;

	*) echo $'Usage: \n\t' \
		"$0" $'-t  to run all the tests \n\t' \
		"$0" $'-b  to build Docker test image \n\t';
	;;
esac
