# installation du projet
 * lancer docker-compose

```
docker-compose up -d
```
 * modification du .env
creer un `.env.local` ou modifier le `.env`

```
DATABASE_URL=mysql://company:company@mysql:3306/company
```
 * Installer composer

 ```
 docker exec company-php-fpm composer install

 ```

 * migrer la Bdd

 ```
 docker exec company-php-fpm bin/console doctrine:migrations:migrate
 ```

 * jouer le script pour importer les formes juridiques
```
docker exec company-php-fpm bin/console app:add-form-juridique documentation/list.txt
```

normalement le site est online ici http://localhost:8080
