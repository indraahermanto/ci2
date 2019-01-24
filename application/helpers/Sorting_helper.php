<?php

/**
 * Helper class with shortcut functions to lookup URL
 */

function build_sorter($key) {
	return function ($a, $b) use ($key) {
		if(is_object($a)) $a = (array) $a;
		if(is_object($b)) $b = (array) $b;
		return strnatcmp($a[$key], $b[$key]);
	};
}