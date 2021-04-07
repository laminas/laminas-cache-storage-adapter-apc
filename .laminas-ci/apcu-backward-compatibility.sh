#!/bin/bash -l

PHP=$1
PACKAGE=php${PHP}-apcu-bc

if [[ "${PHP}" =~ ^5. ]];then
    PACKAGE=php${PHP}-apcu
fi

apt install -y $PACKAGE
echo "Enabling apc for ${PHP} cli"
phpenmod -v ${PHP} -s cli apc

