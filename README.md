Local Drupal Development

This setup is exclusively for local development only.

# Setup

This setup has been tested with :

 * Apple Silicon M1
 * macOS Monterey
 * Local clone
 * Git
 * Docker for Mac
 * Composer
 * Brew

# Usage

 0. `composer create-project dpi/drupal-local`
 1. `cp .env.dist .env` and add values.
 2. `composer install`
 3. Install Certificates, see _Local TLS_ section below.
 4. Optionally copy and remove `dist.` prefix from settings files.
 5. `docker-compose up -d`

## Drupal

Drupal is accessible at https://localhost/

### Installation

```bash
docker-compose exec php-cli bash
drush si standard -y
```

### Common tasks

```bash
# Set Claro as admin theme:
drush theme:enable claro && drush config:set system.theme admin claro -y && drush cr
```

## Alternative hostnames

Want to use a hostname other than localhost, such as DOMAIN.localhost? (automat-
ically works with Firefox / Chrome) Or any others with editing host file?

 1. Update URLs and hostnames in `.env` file.
 2. Generate certificates for new hostname (See _Local TLS_).
 3. `docker-compose up -d`

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

# Development

## PHPStan

Optionally customise PHPStan configuration with
`cp phpstan.neon.dist phpstan.neon`. The .dist file will be used by default.

```bash
phpstan analyse
```

## PHPCS

Optionally customise PHPCS configuration with
`cp phpcs.xml.dist phpcs.xml`. The .dist file will be used by default.

```bash
phpcs
```

## PHPUnit

Optionally customise PHPUnit configuration with
`cp phpunit.xml.dist phpunit.xml`. The .dist file will be used by default.

```bash
phpunit
```

## Blackfire

Define client and server ID and tokens in .env.

### Web profiling

#### Browser extension

Enable the browser extension as normal.

Navigate to the page you wish to profile, and click 'Profile!' button.

Note: does not work properly if you're using Firefox container tabs. Use a
container-less tab when profiling in Firefox.

#### Docker compose

`docker-compose exec blackfire blackfire curl http://nginx:8080/`

#### Blackfire CLI app

Blackfire client (`blackfire`) is built into the PHP CLI container
(`Dockerfile-php-cli`):

```
docker-compose exec php-cli bash
blackfire curl http://nginx:8080/
```

### CLI app profiling

```
docker-compose exec php-cli bash
blackfire run drush foo
```
