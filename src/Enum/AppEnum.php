<?php

namespace App\Enum;

enum AppEnum: string
{
	// intro text
    case APP_TITLE = '<fg=yellow;options=bold>ARRAY</><fg=cyan;options=bold>_HUNT()</>';
    case APP_DESCRIPTION = '<fg=white;options=bold>CLI minigame for programmers who want to sharpen their array accessing skills.</>';
    case STORY_DESCRIPTION = "Evil orcs have stolen the royal treasure and hidden it so well\n" .
        "that even the finest scouts cannot track it down. They have locked it\n" .
        "deep inside... an <fg=yellow;options=bold>Array</>!\n\n" .
        "You are the only knight in the realm who knows how to navigate those\n" .
        "<fg=cyan;options=bold>data fields</> properly. Save the kingdom, find the loot,\n" .
        "and don't get <fg=red>lost</>!";

    case APP_TIPS = "<fg=gray>Tip: You can use both notation styles:</>\n"
            . "<fg=gray>   • Dot notation:  <fg=white>path_1.nodes.2</></>\n"
            . "<fg=gray>   • PHP syntax:    <fg=white>['path_1']['nodes'][2]</> or <fg=white>\$array['path_1'][2]</></>\n";

    case PRESS_ENTER_TO_START = 'Press [ENTER] to start hunting';
    case DUMP_MODE = 'Choose your preferred Dungeon Map view mode';
    case DUMP_MODE_TREE = 'Pretty Tree View (Clean & Colored)';
    case DUMP_MODE_RAW = 'Raw PHP Array View (Classic)';

    // user
	case PROMPT_USER = 'Type path to chest...';
	case MISSED = 'You missed! Try again!';
	case EXIT = 'exit';
	case GOODBYE = 'You exited the game:( See you again....';
	case EMPTY_PATH = 'Path cannot be empty!';
	case GOODJOB = 'Great job knight! Press ENTER to continue to the next level...';
	case GAME_OVER = 'You died! Game over...';
	case VICTORY = 'VICTORY! YOU HAVE CONQUERED THE DUNGEON!';

	// misc
	case ATTEMPTS_TEXT = 'Number of attempts:';
	case HP_TEXT = 'HP:';
	case WRONG_TARGET = 'Wrong target! You must find the chest!';
	case MIMIC_DAMAGE = 'Aaaaargh! It was a Mimic and it bit you!';
	case CHEST_MISSING_KEY = 'Chest is locked! You must find the key.';
	case CHEST_KEY_USED = 'Opening chest with key...';

	// duel
	case ORC_ENCOUNTER = 'You encountered Orc! Fight him!';
	case DUEL_WIN = 'You defeated the Orc! Well done! His pockets are empty...';
	case DUEL_WIN_PLUS_KEY = 'You defeated the Orc! Well done! You looted a key from him!';
	case DUEL_CHOOSE_ATTACK_DIRECTION = 'Choose your attack direction (TOP, LEFT, RIGHT, B_LEFT, B_RIGHT, STAB)';

	//altar
	case ALTAR_NOTHING = 'Altar did nothing...';
	case ALTAR_GRANTED_KEY = 'Lucky you! Altar gave you the key to the chest!';
	case ALTAR_QUIT = 'Scared? Hahahah....';
	case ALTAR_BUFF_LOOT = 'Altar shined with golden light! Your next loot will be gooooood.....';
}
