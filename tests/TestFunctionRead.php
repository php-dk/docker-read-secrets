<?php

use phpdk\dockerReadSecrets\Reader;
use phpdk\dockerReadSecrets\Secret;

class TestRead extends \PHPUnit\Framework\TestCase
{
    const SECRETS_DIR = __DIR__ . '/secrets';
    const PASS_SECRET_NAME = 'db_password';
    const PASS_SECRET_VALUE = 'my_password';

    public function testReadPassword()
    {
        $secret = pdk_secret(self::PASS_SECRET_NAME, null, self::SECRETS_DIR);

        static::assertInstanceOf(Secret::class, $secret);
        static::assertEquals(self::PASS_SECRET_NAME, $secret->getName());
        static::assertEquals(self::PASS_SECRET_VALUE, $secret->getValue());
    }

    public function testReadDefaultValue()
    {
        $secret = pdk_secret('default', '', self::SECRETS_DIR);

        static::assertInstanceOf(Secret::class, $secret);
        static::assertEquals('default', $secret->getName());
        static::assertEquals('', $secret->getValue());
    }

    public function testReadDefaultScalar()
    {
        $value = pdk_secret_read('default', '', self::SECRETS_DIR);
        static::assertEquals('', $value);
    }

    public function testReadScalar()
    {
        $value = pdk_secret_read(self::PASS_SECRET_NAME, '', self::SECRETS_DIR);
        static::assertEquals(self::PASS_SECRET_VALUE, $value);
    }
}
