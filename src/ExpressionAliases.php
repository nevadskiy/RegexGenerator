<?php

trait ExpressionAliases
{
    public function optional($value)
    {
        return $this->maybe($value);
    }

}