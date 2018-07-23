# Docker secret reader

```php
$pass = Reader::new(self::SECRETS_DIR)->get('db_pass')->getValue();

$pass = Reader::new(self::SECRETS_DIR)->getScalar('db_pass');

```
