Installation du projet :
  
    $git clone https://github.com/tounaf/maasil_symfony_fetraharinjatovo
Installer les dependances, se mettre dans le dossier du projet :
  
    $composer install

Creation database :
    
    $php bin/console doctrine:database:create

Lancer les migrations :
    
    $php bin/console dotrine:migrations:migrate ## repondre yes

Faire un seed :
    
    $php bin/console dotrine:fixtures:load

Lancer les tests:
    $./vendor/bin/phpunit

Créer un user pour se connecter sur un client:

    $php bin/console app:user:create username password

Lancer du projet, au choix :
    
    $symfony serve
ou 
    
    $php bin/console server:run

ou Mettre le projet dans un serveur web comme xampp, lamp, ou wampp
    
    


    
