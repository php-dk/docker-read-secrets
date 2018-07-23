# Docker secret reader

composer require phpdk/docker-read-secters

```php
$pass = Reader::new(self::SECRETS_DIR)->get('db_pass')->getValue();

$pass = Reader::new(self::SECRETS_DIR)->getScalar('db_pass');

```
