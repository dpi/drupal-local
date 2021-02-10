Local Drupal Development

This setup is exclusively for local development only.

# Usage

 1. `cp .env.dist .env` and add values.
 2. `composer install`
 3. Install Certificates, see _Local TLS_ section below.
 4. Optionally copy and remove `dist.` prefix from settings files.
 5. `docker-compose up -d`

## Drupal

Drupal is accessible at https://localhost/

### Installation

```bash
docker-compose run php-cli bash
drush si standard -y
```

### Redis

```bash
# Enable Redis before copying files because new services depend on Redis.module.
drush en redis
cp ./app/sites/default/dist.settings.redis.php ./app/sites/default/settings.redis.php
cp ./app/sites/default/dist.services.redis.yml ./app/sites/default/services.redis.php
drush cr
```

### Configuration Export/Import

Config YAML will be exported to `./config/`, alternatively use MySQL dump and
auto restoration per below.

```bash
drush config:export
drush config:import
```

## Local TLS

[Why local HTTPS][local-https]? Just because! Also Secure Cookies! And other
things probably.

```bash
brew install mkcert nss
# Replace 'localhost' with alternative hostname, if desired.
mkcert -cert-file=certificates/primary.pem -key-file=certificates/primary-key.pem localhost
mkcert -install
```

More certificates can be defined in `traefik/config/certificates.yaml`.

 [local-https]: https://web.dev/how-to-use-local-https/

## MySQL Dump

Dump the MySQL database from the PHPCLI container so the setup can be restarted.

```bash
drush sql-dump --result-file=../sql/init/dump.sql
```

The dump will be automatically imported if you `docker-compose down` then
restart the application. The app will take a few extra seconds to be ready. Tail
the database log with `docker-compose logs -f db` to track progress. 

## Mailhog

Mailhog will capture emails sent by Drupal. There is no need to configure Drupal
as `sendmail_path` is [configured][sendmail-php-ini].

Mailhog is accessible at https://localhost/mailhog/

 [sendmail-php-ini]: https://github.com/skpr/containers/blob/master/php/base/conf.d/50_overrides.ini

## Traefik

Dashboard is accessible at https://localhost/traefik/ 
