<?php declare(strict_types=1);

namespace phpdk\dockerReadSecrets;

class Secret
{
    /** @var string */
    protected $name;
    /** @var string|null */
    protected $value;

    /**
     * Secret constructor.
     * @param string $name
     * @param string|int|float $value
     * @throws \Exception
     */
    public function __construct(string $name, $value)
    {
        $this->name = $name;

        if ($value && !is_scalar($value)) {
            throw new \Exception('Secret support only scalar values');
        }

        $this->value = $value;
    }

    public static function createByFile(string $file): self
    {
        $name = basename($file);
        if (!file_exists($file)) {
            return new static($name, null);
        }

        $value = file_get_contents($file);
        $value = str_replace(["\n",], '', $value);

        return new static($name, $value);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|int|float|null
     */
    public function getValue()
    {
        return $this->value;
    }
}
