#!/bin/sh
set -e
#
# This script is meant for quick & easy install via:
#   'curl -sSL https://raw.githubusercontent.com/delete/thanksforallthefish/master/install.sh | sh'

remove_zip_file() {
	# Remove zip file if it does exist
	if [ -f "$(pwd)/master.zip" ]; then
		rm "$(pwd)/master.zip"
	fi
}

install_tfatf() {
	
	remove_zip_file
	
	#Dowloading
	wget "https://github.com/delete/thanksforallthefish/archive/master.zip"

	# Unzipping and copying to the right path
	unzip -u "master.zip" 'thanksforallthefish-master/tfatf/*' -d "$(pwd)/"
	cp -r "$(pwd)/thanksforallthefish-master/tfatf"* "$(pwd)/" -v

	# Create public directy if it does exist
	if [ ! -d "$(pwd)/public" ]; then
		mkdir "$(pwd)/public"
	fi
	# Move default index.php to public directory if it does not exist
	if [ ! -f "$(pwd)/public/index.php" ]; then
		mkdir "$(pwd)/public"
		cp "$(pwd)/tfatf/configs/site_defaut/index.php" "$(pwd)/public/"
	fi
	# Move default settings.php to root directory if it does not exist
	if [ ! -f "$(pwd)/settings.php" ]; then
		cp "$(pwd)/tfatf/configs/site_defaut/settings.php" "$(pwd)/"
	fi
	# Move all defaults configs files to config default directory if it does not exist
	if [ ! -d "$(pwd)/configs/" ]; then
		mkdir "$(pwd)/configs"
		cp -r "$(pwd)/tfatf/configs/site_defaut/site_configs"* "$(pwd)/configs/"
	fi

	# Cleaning
	rm -r "$(pwd)/thanksforallthefish-master/"
	remove_zip_file
}

install_smarty(){
	SMARTY_VERSION="v3.1.30.zip"
	SMARTY_PATH="$(pwd)/vendors/smarty/"
	SMART_UNZIP="smarty-3.1.30/"
	SMART_LIBS="smarty-3.1.30/libs/"

	# If the smarty directory not exists, create it!
	if [ -d "$SMARTY_PATH" ]; then
		printf "\n\n\t Smarty already installed!! \n\n"
		return 0
	else
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
	# chown apache:apache -R "$SMARTY_PATH""templates_c/"
	
	# Clenaing the mess
	rm -r "$SMARTY_PATH""$SMART_UNZIP"
	rm "$SMARTY_VERSION"

	printf "\n\n\t Smarty installed!! \n\n"
}

# Starts everything
install_tfatf
install_smarty


printf "\n\n\t Thanks For All The Fish has been installed!! \n\n"