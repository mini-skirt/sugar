<?php
namespace MiniSkirt\Sugar\Util;

class DS
{
    public static function isNA($value): bool
    {
        return ($value instanceof \MiniSkirt\Sugar\DS\NA);
    }
}