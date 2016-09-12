#!/bin/bash

# GLOBAL VARIABLES
ROOT="/app"

# COMMAND LINE VARIABLES
COMMAND=$1

# DOCKER FUNCTIONS

del_stopped(){
	local name=$1
	local state
	state=$(docker inspect --format "{{.State.Running}}" "$name" 2>/dev/null)

	if [[ "$state" == "false" ]]; then
		docker rm "$name"
	fi
}

run_test(){
	docker run --rm \
		-v "$(pwd)":$ROOT \
		alpine-phpunit:3.3 --bootstrap $ROOT/tfatf/autoload.php $ROOT/tests
}

run_server(){
	del_stopped tfatf
	docker run --rm \
		--name=tfatf \
		-e "WEBAPP_ROOT=public/" \
		-v "$(pwd)":/$ROOT \
		-p 80:80 \
		alpine-php:3.3
}

build_images(){
	docker build -t alpine-php:3.3 . && cd /tests && docker build -t alpine-phpunit:3.3 .
}

# INSTALL FUNCTIONS

install_smarty(){
	SMARTY_VERSION="v3.1.30.zip"
	SMARTY_PATH="$(pwd)/vendors/smarty/"
	SMART_UNZIP="smarty-3.1.30/"
	SMART_LIBS="smarty-3.1.30/libs/"

	# If the smarty directory not exists, create it!
	if [ ! -d "$SMARTY_PATH" ]; then
		mkdir -p "$SMARTY_PATH"
	fi
	# If the smarty zip file exists, delete it!
	if [ -f "$SMARTY_VERSION" ]; then
		rm "$SMARTY_VERSION"
	fi

	# Dowloading
	wget "https://github.com/smarty-php/smarty/archive/$SMARTY_VERSION"

	# Moving to the right path
	unzip "$SMARTY_VERSION" 'smarty-3.1.30/libs/*' -d "$SMARTY_PATH"
	mv "$SMARTY_PATH""$SMART_LIBS"* "$SMARTY_PATH" -v

	# Permissions
	chmod 777 -R "$SMARTY_PATH"
	chown apache:apache -R "$SMARTY_PATH""templates_c/"
	
	# Clenaing the mess
	rm -r "$SMARTY_PATH""$SMART_UNZIP"
	rm "$SMARTY_VERSION"

	printf "\n\n\t Smarty installed!! \n\n"
}


# MENU
case "$COMMAND" in
	-t) run_test; ;;
	-r) run_server; ;;
	-b) build_images; ;;
	-i) install_smarty ;;

	*) echo $'Usage: \n\t' "$0" \
		 $'-t  to run all tests \n\t' "$0" \
		 $'-r  to run the local server \n\t' "$0" \
		 $'-b  to buld Docker images \n\t' "$0" \
		 $'-i  to install Smarty template engine'; 
	;;
esac
