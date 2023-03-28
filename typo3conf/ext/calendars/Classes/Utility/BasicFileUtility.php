<?php

namespace CodingMs\Calendars\Utility;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2019 Thomas Deuling <typo3@coding.ms>
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Charset\CharsetConverter;

/**
 * Basic file management
 *
 * ChangeLog Version:
 * *    [TASK]
 *
 */
class BasicFileUtility
{
    /**
     * @var string
     */
    const UNSAFE_FILENAME_CHARACTER_EXPRESSION = '\\x00-\\x2C\\/\\x3A-\\x3F\\x5B-\\x60\\x7B-\\xBF';

    /**
     * Returns a string where any character not matching [.a-zA-Z0-9_-] is substituted by '_'
     * Trailing dots are removed
     *
     * @param string $fileName Input string, typically the body of a filename
     * @return string Output string with any characters not matching [.a-zA-Z0-9_-] is substituted by '_' and trailing dots removed
     */
    public static function cleanFileName($fileName)
    {
        // Handle UTF-8 characters
        if ($GLOBALS['TYPO3_CONF_VARS']['SYS']['UTF8filesystem']) {
            // allow ".", "-", 0-9, a-z, A-Z and everything beyond U+C0 (latin capital letter a with grave)
            $cleanFileName = preg_replace('/[' . self::UNSAFE_FILENAME_CHARACTER_EXPRESSION . ']/u', '_', trim($fileName));
        } else {
            $fileName = GeneralUtility::makeInstance(CharsetConverter::class)->utf8_char_mapping($fileName);
            // Replace unwanted characters by underscores
            $cleanFileName = preg_replace('/[' . self::UNSAFE_FILENAME_CHARACTER_EXPRESSION . '\\xC0-\\xFF]/', '_', trim($fileName));
        }
        // Strip trailing dots and return
        return rtrim($cleanFileName, '.');
    }
}
