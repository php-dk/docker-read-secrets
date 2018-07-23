<?php

use phpdk\dockerReadSecrets\Reader;
use phpdk\dockerReadSecrets\Secret;

/**
 * Created by PhpStorm.
 * User: dima
 * Date: 23.07.18
 * Time: 10:29
 */

class TestRead extends \PHPUnit\Framework\TestCase
{
    const SECRETS_DIR = __DIR__ . '/secrets';

    protected function getReader(): Reader
    {
        return new Reader(self::SECRETS_DIR);
    }

    public function testReadPassword()
    {
        $reader = $this->getReader();
        $secret = $reader->get('db_password');

        static::assertInstanceOf(Secret::class, $secret);
        static::assertEquals('db_password', $secret->getName());
        static::assertEquals('my_password', $secret->getValue());
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
        $value = $this->getReader()->getScalar('db_password', '');
        static::assertEquals('my_password', $value);
    }

    public function testCreateSecretByFileName()
    {
        $secret = Secret::createByFile(self::SECRETS_DIR . '/' . 'db_password');
        static::assertEquals('db_password', $secret->getName());
        static::assertEquals('my_password', $secret->getValue());
    }
}
