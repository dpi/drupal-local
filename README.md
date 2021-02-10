Local Drupal Development

This setup is exclusively for local development only.

# Usage

 1. `cp .env.dist .env` and add values.
 2. `composer install`
 3. Install Certificates, see below.
 4. Optionally copy and remove `dist.` prefix from settings files.
 5. `docker-compose up -d`

## Drupal

Drupal is accessible at https://localhost/

### Installation

```bash
docker-compose run php-cli bash
drush si standard -y
```

## Local TLS

[Why local HTTPS][local-https]? Just because! Also Secure Cookies! And other things probably.

```bash
brew install mkcert nss
mkcert -cert-file=certificates/localhost.pem -key-file=certificates/localhost-key.pem localhost
mkcert -install
```

 [local-https]: https://web.dev/how-to-use-local-https/

## MySQL Dump

Dump the MySQL database from the PHPCLI container so the setup can be restarted.

```bash
drush sql-dump --result-file=../sql/init/dump.sql
```

## Mailhog

Mailhog will capture emails sent by Drupal. There is no need to configure Drupal
as `sendmail_path` is [configured][sendmail-php-ini].

Mailhog is accessible at https://localhost/mailhog/

 [sendmail-php-ini]: https://github.com/skpr/containers/blob/master/php/base/conf.d/50_overrides.ini
