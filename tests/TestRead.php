<?php

use phpdk\dockerReadSecrets\Reader;
use phpdk\dockerReadSecrets\Secret;

class TestRead extends \PHPUnit\Framework\TestCase
{
    const SECRETS_DIR = __DIR__ . '/secrets';
    const PASS_SECRET_NAME = 'db_password';
    const PASS_SECRET_VALUE = 'my_password';

    protected function getReader(): Reader
    {
        return new Reader(self::SECRETS_DIR);
    }

    public function testReadPassword()
    {
        $reader = $this->getReader();
        $secret = $reader->get(self::PASS_SECRET_NAME);

        static::assertInstanceOf(Secret::class, $secret);
        static::assertEquals(self::PASS_SECRET_NAME, $secret->getName());
        static::assertEquals(self::PASS_SECRET_VALUE, $secret->getValue());
    }

    public function testReadDefaultValue()
    {
        $reader = $this->getReader();
        $secret = $reader->get('default', '');

        static::assertInstanceOf(Secret::class, $secret);
        static::assertEquals('default', $secret->getName());
        static::assertEquals('', $secret->getValue());
    }

    public function testReadDefaultScalar()
    {
        $value = $this->getReader()->getScalar('default', '');
        static::assertEquals('', $value);
    }

    public function testReadScalar()
    {
        $value = $this->getReader()->getScalar(self::PASS_SECRET_NAME, '');
        static::assertEquals(self::PASS_SECRET_VALUE, $value);
    }

    public function testCreateSecretByFileName()
    {
        $secret = Secret::createByFile(self::SECRETS_DIR . '/' . self::PASS_SECRET_NAME);
        static::assertEquals(self::PASS_SECRET_NAME, $secret->getName());
        static::assertEquals(self::PASS_SECRET_VALUE, $secret->getValue());
    }
}
