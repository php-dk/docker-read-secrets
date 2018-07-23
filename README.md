# Docker secret reader


composer require phpdk/docker-read-secrets

```php
$pass = Reader::new(self::SECRETS_DIR)->get('db_pass')->getValue();

$pass = Reader::new(self::SECRETS_DIR)->getScalar('db_pass');

```
or 

```php
$pass = pdk_secret_read('db_pass');

```
