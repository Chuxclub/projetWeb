#!/bin/sh
wget https://get.symfony.com/cli/installer -O installer.sh
chmod 755 installer.sh
./installer.sh --install-dir .
/bin/rm installer.sh
echo "Déplacez le fichier dans un répertoire du PATH"
