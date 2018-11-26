<?php

namespace PsychoB\EOS\Entity;

use CaseHelper\CaseHelperFactory;
use PsychoB\EOS\Exception\KeyNotFoundException;

class AbstractEntity
{
    /** @var array */
    protected $data = [];

    /**
     * AbstractEntity constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __get($name)
    {
        if (strpos($name, 'get') !== 0) {
            throw new InvalidGetterException($name);
        }

        return $this->getImpl(substr($name, 3));
    }

    protected function getImpl(string $name)
    {
        $name = $this->toSnakeCase($name);

        if (!array_key_exists($name, $this->data)) {
            throw new KeyNotFoundException($name, array_keys($this->data));
        }

        return $this->data[$name];
    }

    protected static function toSnakeCase(string $name): string
    {
        static $helper = null;
        if ($helper === null) {
            $helper = CaseHelperFactory::make(CaseHelperFactory::INPUT_TYPE_CAMEL_CASE);
        }

        return $helper->toSnakeCase($name);
    }
}
