<?php
namespace MiniSkirt\Sugar\HumanReadableMedium\System;

class PrimitiveType
{
    const DISPLAY_ARRAY           = '[...]';
    const DISPLAY_ARRAY_EMPTY     = '[]';
    const DISPLAY_BOOL_TRUE       = 'TRUE';
    const DISPLAY_BOOL_FALSE      = 'FALSE';
    const DISPLAY_CALLABLE        = 'f(x)';
    const DISPLAY_RESOURCE        = '{*IO}';
    const DISPLAY_NULL            = 'NULL';
    const DISPLAY_FALLBACK        = '...';
    
    public static function toText($variable): string
    {
        return match($variable) {
            true    => static::DISPLAY_BOOL_TRUE,
            false   => static::DISPLAY_BOOL_FALSE,
            null    => static::DISPLAY_NULL,
            []      => static::DISPLAY_ARRAY_EMPTY,
            default => match(true) {
                is_callable($variable) => static::DISPLAY_CALLABLE,
                is_array($variable)    => static::DISPLAY_ARRAY,
                is_string($variable)   => '"'.$variable.'"',
                is_numeric($variable)  => $variable,
                is_resource($variable) => static::DISPLAY_RESOURCE,
                is_object($variable)   => GeneralObject::toText($variable),
                default                => static::DISPLAY_FALLBACK
            }
        };
    }
}