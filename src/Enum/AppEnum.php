<?php

namespace App\Enum;

enum AppEnum: string
{
	// intro text
    case APP_TITLE = '<fg=yellow;options=bold>ARRAY</><fg=cyan;options=bold>_HUNT()</>';
    case APP_DESCRIPTION = '<fg=white;options=bold>CLI minigame for programmers who want to sharpen their array accessing skills.</>';
    case STORY_DESCRIPTION = "Evil orcs have stolen the royal treasure and hidden it so well\n" .
        "that even the finest scouts cannot track it down. They have locked it\n" .
        "deep inside... an <fg=yellow;options=bold>Associative Array</>!\n\n" .
        "You are the only knight in the realm who knows how to wield square\n" .
        "brackets <fg=cyan;options=bold>[]</> properly. Save the kingdom, find the loot,\n" .
        "and don't get <fg=red>lost</>!";

    case APP_TIPS = "<fg=gray>Tip: You can use both notation styles:</>\n"
            . "<fg=gray>   • Dot notation:  <fg=white>path_1.nodes.2</></>\n"
            . "<fg=gray>   • PHP syntax:    <fg=white>['path_1']['nodes'][2]</> or <fg=white>\$array['path_1'][2]</></>\n";

    case PRESS_ENTER_TO_START = 'Press [ENTER] to start hunting';

    // user
	case PROMPT_USER = 'Type path to chest...';
	case MISSED = 'You missed! Try again!';
	case EXIT = 'exit';
	case GOODBYE = 'You exited the game:( See you again....';
	case EMPTY_PATH = 'Path cannot be empty!';
	case GOODJOB = 'Great job knight! Press ENTER to continue to the next level...';

	// misc
	case ATTEMPTS_TEXT = 'Number of attempts:';
	case WRONG_TARGET = 'Wrong target! You must find the chest!';
}
