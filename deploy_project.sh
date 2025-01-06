#!/bin/bash

#Maj avant installation 
sudo apt-get update
#si besoin de Maj
sudo apt-get upgrade

#installation des dépendances 
sudo apt-get install -y apt-transport-https ca-certificates curl gnupg lsb-release
#ajout du référentiel docker curl
curl -fsSL https://download.docker.com/linux/debian/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
#enregistrement du lien pour les futur Maj
echo "deb [arch=amd64 signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/debian $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

#installation docker engine
sudo apt-get install -y docker.io
#configuration des permissions
sudo usermod -aG docker $USER
#démarrage du service 
sudo systemctl start docker
#verification de la version installée
docker --version
#lancement du test fourni par docker
docker run hello-world
#installation docker-compose
sudo apt install docker-compose

#installation du pare-feu(ssh ouvert au port 22)
sudo apt-get install ufw
#blocage des connexions entrantes 
sudo ufw default deny incoming 
#autorisation des flux sortant 
sudo ufw default allow outgoing
#autorisation du port 22 ssh
sudo ufw allow ssh
#activation du par-feu
sudo ufw enabled
#vérification des règles actives
sudo ufw status numbered
