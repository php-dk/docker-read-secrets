<?php declare(strict_types=1);

namespace phpdk\dockerReadSecrets;

class Reader
{
    /** @var string */
    protected $dir;

    /**
     * Reader constructor.
     * @param string $dir
     */
    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    /**
     * @param string $dir
     * @return static
     */
    public static function new(string $dir)
    {
        return new static($dir);
    }

    public static function readScalar(string $file, string $name, $defValue = null)
    {
        return static::new($file)->getScalar($name, $defValue);
    }

    public function get($name, $defaultValue = null): Secret
    {
        $secret = Secret::createByFile($this->dir . '/' . $name);
        if ($secret->getValue() === null) {
            return new Secret($name, $defaultValue);
        }

        return $secret;
    }

    /**
     * @param $name
     * @param null $defaultValue
     * @return float|int|null|string
     */
    public function getScalar($name, $defaultValue = null)
    {
        return $this->get($name, $defaultValue)->getValue();
    }
}
