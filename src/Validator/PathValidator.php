<?php

namespace App\Validator;

class PathValidator
{
	/**
	* todo
	* @return 
	*/
	public static function evaluateDotNotationPath(array $generatedArray, string $userInput)
	{
		$cleanInput = trim($userInput);

		if (empty($cleanInput)) {
			return null;
		}

		$keys = explode('.', $cleanInput); // break user input by dot
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
}
