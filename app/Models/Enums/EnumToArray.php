<?php

namespace App\Models\Enums;

trait EnumToArray
{

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function toNamesString()
    {
        return implode(',', self::names());
    }

    public static function array(): array
    {
        return array_combine(self::names(), self::values());
    }

    public static function getByName(mixed $findId)
    {
        foreach (self::array() as $id => $value) {
            if ($id === $findId) {
                return $value;
            }
        }
    }
}
