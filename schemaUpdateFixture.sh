# Créer les tables ou les mettre à jours

php bin/console doctrine:query:sql "DROP TABLE IF EXISTS Facture, Client, Vendeur, Vehicule"
php bin/console doctrine:schema:update  --force
php bin/console doctrine:fixtures:load  --verbose --no-interaction