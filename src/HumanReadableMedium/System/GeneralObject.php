<?php
namespace MiniSkirt\Sugar\HumanReadableMedium\System;

class GeneralObject
{
    const DISPLAY_ARRAY_ACCESS = '{[] ArrayAccess}';
    const DISPLAY_CLOSURE      = '{() Closure}';
    const DISPLAY_MAP          = '{...}';
    const DISPLAY_MAP_EMPTY    = '{}';
    const DISPLAY_UNKNOWN      = '{?}';
    const DISPLAY_TRAVERSABLE  = '{> Traversable}';
    const DISPLAY_THROWABLE    = '{! Throwable}';
    const DISPLAY_SERIALIZABLE = '{: Serializable}';
    const DISPLAY_WEAK_MAP     = '{[] WeakMap}';
    const DISPLAY_WEAK_REF     = '{@ WeakRef}';    
    const DISPLAY_GENERATOR    = '{^ Generator}';

    public static function toText(object $inst): string
    {
        if ($inst instanceof \stdClass) {
            if (empty((array) $inst)) return static::DISPLAY_MAP_EMPTY;
            return static::DISPLAY_MAP;
        }

        return match (true) {
            ($inst instanceof \WeakMap)       => static::DISPLAY_WEAK_MAP,
            ($inst instanceof \WeakReference) => static::DISPLAY_WEAK_REF,
            ($inst instanceof \Generator)     => static::DISPLAY_GENERATOR,
            ($inst instanceof \Throwable)     => static::DISPLAY_THROWABLE,
            ($inst instanceof \Closure)       => static::DISPLAY_CLOSURE,
            ($inst instanceof \ArrayAccess)   => static::DISPLAY_ARRAY_ACCESS,
            ($inst instanceof \Serializable)  => static::DISPLAY_SERIALIZABLE,
            ($inst instanceof \Traversable)   => static::DISPLAY_TRAVERSABLE,
            default => static::DISPLAY_UNKNOWN
        };
    }
}