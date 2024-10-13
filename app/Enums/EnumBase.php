<?php

namespace App\Enums;

trait EnumBase
{
    public static function keys(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function toArray(): array
    {
        static $cache = [];

        if ($cache)
            return $cache;

        $cache = self::createArray();

        return $cache;
    }

    private static function createArray(): array {
        $items = [];

        foreach(self::cases() as $item)
            $items[((array) $item)['name']] = ((array) $item)['value'];

        return $items;
    }
}
