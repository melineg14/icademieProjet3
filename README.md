Etapes de config :

1) lancer la commande suivante dans le répertoire : docker-compose build
2) se connecter au bash php: docker exec -it -u dev sf4_php bash
3) vérifier d'être bien dans le dossier sf4
4) composer install && npm install


Commandes Docker basiques :

docker-compose ps: voir les containeurs actifs
docker-compose up -d: lancer les containers
docker-compose down: quitter les containers
docker exec -it -u dev sf4_php bash: se connecter au bash php (principal espace de travail)
docker exec -it -u dev sf4_mysql bash: se connecter au bash mysql