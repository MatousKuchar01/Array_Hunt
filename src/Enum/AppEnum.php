<?php

namespace App\Enum;

enum AppEnum: string
{
	// intro text
    case APP_TITLE = '<fg=yellow;options=bold>ARRAY</><fg=cyan;options=bold>_HUNT()</>';
    case APP_DESCRIPTION = '<fg=white;options=bold>CLI minigame for programmers who want to sharpen their array accessing skills.</>';
    case STORY_DESCRIPTION = '<fg=white>Game intro story......</>';
    case PRESS_ENTER_TO_START = 'Press [ENTER] to start hunting';

    // user
	case PROMPT_USER = 'Type path to chest...';

	// misc
	case ATTEMPTS_TEXT = 'Number of attempts:';
}
