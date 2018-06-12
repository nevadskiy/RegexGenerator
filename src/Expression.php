<?php

class Expression
{
    use ExpressionAliases;

    protected $expression = '';
    protected $delimiter = '/';

    public static function make()
    {
        return new static;
    }

    public function get()
    {
        return $this->delimiter . $this->expression . $this->delimiter;
    }

    public function __toString()
    {
        // var_dump($this->get());
        return $this->get();
    }

    public function test($value)
    {
        return (bool)preg_match($this, $value);
    }

    protected function escape($value)
    {
        return preg_quote($value, $this->delimiter);
    }

    protected function add($value)
    {
        $this->expression .= $value;

        return $this;
    }

    public function find($value)
    {
        return $this->add($this->escape($value));
    }

    public function then($value)
    {
        return $this->find($value);
    }

    public function anything()
    {
        return $this->add('.*');
        }

    public function maybe($value)
    {
        return $this->add('(?:' . $this->escape($value) . ')?');
    }

    public function exclude($value)
    {
        return $this->add('(?!' . $this->escape($value) . ').*?');
    }
}