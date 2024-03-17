<?php

/**
 * Get abbreviation from username
 *
 * @param $username
 * @return string
 */
function getAbbreviation($username): string
{
    $words = explode(' ', $username);
    if (count($words) > 1) { // if name consists of more than one word
        $abbreviation = $words[0][0] . $words[1][0];
    } else {
        $abbreviation = $words[0][0] . $words[0][1];
    }

    return strtoupper($abbreviation);
}
