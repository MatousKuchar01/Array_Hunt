<?php

declare(strict_types=1);

namespace App\Validator;

class PathValidator
{
    /**
     * @param array<string|int, mixed> $generatedArray
     * @param string $userInput
     * @return mixed
     */
	public static function evaluateDotNotationPath(array $generatedArray, string $userInput): mixed
	{
		$cleanInput = trim($userInput);

		if (empty($cleanInput)) {
			return null;
		}

		$normalizedPath = self::normalizeBracketsToDots($cleanInput);

		$keys = explode('.', $normalizedPath); // break user input by dot
		$current = $generatedArray;

		foreach ($keys as $key) {
			if (ctype_digit($key)) { // if user key containts only digits, then cast to int for index validation
				$key = (int) $key;
			}

			if (is_array($current) && array_key_exists($key, $current)) {
				$current = $current[$key];
			} else {
				return null;
			}
		}


		return $current;
	}

	/**
     * @param string $cleanInput
     * @return string
     */
	private static function normalizeBracketsToDots(string $cleanInput): string
	{
	    // check if it is already dot notation
		if (!str_contains($cleanInput, '[')) {
		    return $cleanInput;
		}

		// get everything that is inside square brackets [ ... ]
		preg_match_all('/\[\s*[\'"]?(.*?)[\'"]?\s*\]/', $cleanInput, $m);

		if (!empty($m[1])) {
		    return implode('.', $m[1]);
		}

		return $cleanInput;
	}
}
