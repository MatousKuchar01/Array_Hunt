<?php

namespace App\Enum;

enum Map: string
{
    // VARIANTS OF ROOMS
    case PREFIX_DARK = 'dark';
    case PREFIX_ANCIENT = 'ancient';
    case PREFIX_MOSSY = 'mossy';
    case PREFIX_DUSTY = 'dusty';
    case PREFIX_BLOODY = 'bloody';
    case PREFIX_FORGOTTEN = 'forgotten';
    case PREFIX_SERCRET = 'secret';
    case PREFIX_HAUNTED = 'haunted';
    case PREFIX_SUNKEN = 'sunken';

    // TYPES OF ROOMS
    case LOCATION_CORRIDOR = 'corridor';
    case LOCATION_CHAMBER = 'chamber';
    case LOCATION_HALL = 'hall';
    case LOCATION_TUNNEL = 'tunnel';
    case LOCATION_VAULT = 'vault';
    case LOCATION_CRYPT = 'crypt';
    case LOCATION_DUNGEON = 'dungeon';
    case LOCATION_PASSAGE = 'passage';
    case LOCATION_CAVE = 'cave';

    /** @return array */
    public static function getAllVariants(): array
    {
        return [
            self::PREFIX_DARK->value,
            self::PREFIX_ANCIENT->value,
            self::PREFIX_MOSSY->value,
            self::PREFIX_DUSTY->value,
            self::PREFIX_BLOODY->value,
            self::PREFIX_FORGOTTEN->value,
            self::PREFIX_SERCRET->value,
            self::PREFIX_HAUNTED->value,
            self::PREFIX_SUNKEN->value,
        ];
    }

    /** @return array */
    public static function getAllTypes(): array
    {
        return [
            self::LOCATION_CORRIDOR->value,
            self::LOCATION_CHAMBER->value,
            self::LOCATION_HALL->value,
            self::LOCATION_TUNNEL->value,
            self::LOCATION_VAULT->value,
            self::LOCATION_CRYPT->value,
            self::LOCATION_DUNGEON->value,
            self::LOCATION_PASSAGE->value,
            self::LOCATION_CAVE->value,
        ];
    }
}
