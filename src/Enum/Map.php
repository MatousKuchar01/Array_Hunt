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
    case PREFIX_ECHOING = 'echoing';
    case PREFIX_FROZEN = 'frozen';
    case PREFIX_BURNING = 'burning';
    case PREFIX_POISONOUS = 'poisonous';
    case PREFIX_SILENT = 'silent';
    case PREFIX_CURSED = 'cursed';
    case PREFIX_SHADOWY = 'shadowy';
    case PREFIX_RUSTY = 'rusty';
    case PREFIX_WHISPERING = 'whispering';
    case PREFIX_BURIED = 'buried';
    case PREFIX_DAMP = 'damp';
    case PREFIX_GLOOMY = 'gloomy';
    case PREFIX_SACRED = 'sacred';
    case PREFIX_ABANDONED = 'abandoned';

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
    case LOCATION_SANCTUARY = 'sanctuary';
    case LOCATION_CATACOMB = 'catacomb';
    case LOCATION_LABYRINTH = 'labyrinth';
    case LOCATION_ABYSS = 'abyss';
    case LOCATION_SHRINE = 'shrine';
    case LOCATION_SEWER = 'sewer';
    case LOCATION_CELL = 'cell';
    case LOCATION_NEXUS = 'nexus';
    case LOCATION_ALCOVE = 'alcove';
    case LOCATION_PIT = 'pit';
    case LOCATION_GROTTO = 'grotto';
    case LOCATION_TOMB = 'tomb';

    /** @return array */
    public static function getAllVariants(): array
    {
        return array_values(array_map(
            fn(self $case) => $case->value,
                array_filter(self::cases(), fn(self $case) => str_starts_with($case->name, 'PREFIX_'))
            )
        );
    }

    /** @return array */
    public static function getAllTypes(): array
    {
        return array_values(array_map(
            fn(self $case) => $case->value,
                array_filter(self::cases(), fn(self $case) => str_starts_with($case->name, 'LOCATION_'))
            )
        );
    }

    /**
     * generates a shorter name for room (damp_hall = dh)
     * for quicker navigation through array
     * @param string $roomName
     * @return string
     */
    public static function generateAlias(string $roomName): string
    {
        $parts = explode('_', $roomName);
        $alias = '';

        foreach ($parts as $part) {
            if (!empty($part)) {
                $alias .= $part[0]; // first letter
            }
        }

        return strtolower($alias);
    }
}
