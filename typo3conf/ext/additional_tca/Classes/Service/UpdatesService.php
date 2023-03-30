<?php

declare(strict_types=1);

namespace CodingMs\AdditionalTca\Service;

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

use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Perform an Update-Check
 *
 * @author Thomas Deuling <typo3@coding.ms>
 *
 * ChangeLog:
 * 2022-01-25 Migration for TYPO3 10.4/11.5
 * 2019-05-28 Migration for TYPO3 8.7/9.5
 * 2019-01-19 Exchanging CURL/file_get_contents by GeneralUtility::get and refactoring
 * 2017-06-08 Modify comments
 */
class UpdatesService
{

    /**
     * Check for Updates by CURL or file_get_contents
     *
     * @param string $extension Extension-Key
     * @param array<int, int|string> $thisVersionParts Version number parts
     * @return bool|string Returns false in case of current version, otherwise the update message.
     */
    public static function check(string $extension, array $thisVersionParts)
    {
        //
        // Validate this-version, because in case of small version numbers
        // or composer dev-master usage, not all number parts are valid!
        $thisVersionParts[0] = isset($thisVersionParts[0]) ? (int)$thisVersionParts[0] : 0;
        $thisVersionParts[1] = isset($thisVersionParts[1]) ? (int)$thisVersionParts[1] : 0;
        $thisVersionParts[2] = isset($thisVersionParts[2]) ? (int)$thisVersionParts[2] : 0;
        //
        $updateMessage = false;
        $url = 'https://www.coding.ms/updates/' . implode('.', $thisVersionParts) . '/' . $extension . '.json';
        $key = 'AdditionalTca';
        $prefix = 'tx_additionaltca_message.';
        //
        // Get current version
        /** @var RequestFactory $requestFactory */
        $requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
        $response = $requestFactory->request($url, 'GET', [
            'headers' => [
                'Referer' => GeneralUtility::getIndpEnv('TYPO3_HOST_ONLY')
            ],
        ]);
        if ($response->getStatusCode() === 200) {
            $currentVersionJson = $response->getBody()->getContents();
        } else {
            return (string)LocalizationUtility::translate($prefix . 'error_version_not_detected', $key);
        }
        // Parsing JSON failed?
        $currentVersionArray = json_decode($currentVersionJson, true);
        if (!$currentVersionArray) {
            return (string)LocalizationUtility::translate($prefix . 'error_version_json_invalid', $key);
        }
        $currentVersionParts = explode('.', $currentVersionArray['version']);
        //
        // Major-Release is higher
        // Installed Version>Update-Check-Version
        $isNewerThanRegisteredOnes = false;
        if ($thisVersionParts[0] > (int)$currentVersionParts[0]) {
            $isNewerThanRegisteredOnes = true;
        }
        // Major-Release lower
        // Installed Version<Update-Check-Version
        else {
            if ($thisVersionParts[0] < (int)$currentVersionParts[0]) {
                $updateMessage = (string)LocalizationUtility::translate($prefix . 'info_major_release_available', $key);
            } // Otherwise, just a minor release or a patch can be possible
            else {
                // Minor-Release higher
                // Installed Version>Update-Check-Version
                if ($thisVersionParts[1] > (int)$currentVersionParts[1]) {
                    $isNewerThanRegisteredOnes = true;
                } else {
                    // Minor-Release lower
                    if ($thisVersionParts[1] < (int)$currentVersionParts[1]) {
                        $updateMessage = (string)LocalizationUtility::translate($prefix . 'info_minor_release_available', $key);
                    } else {
                        if ($thisVersionParts[2] < (int)$currentVersionParts[2]) {
                            // Otherwise, just a patch can be possible
                            $updateMessage = (string)LocalizationUtility::translate($prefix . 'info_patch_available', $key);
                        } elseif ($thisVersionParts[2] > (int)$currentVersionParts[2]) {
                            $isNewerThanRegisteredOnes = true;
                        }
                    }
                }
            }
        }
        $thisVersionString = $thisVersionParts[0] . '.' . $thisVersionParts[1] . '.' . $thisVersionParts[2];
        $thisVersionString = '(' . $thisVersionString . ' -> ' . $currentVersionArray['version'] . ')';
        if ($isNewerThanRegisteredOnes) {
            $updateMessage = 'Your version is newer than registered ones! ';
            $updateMessage .= 'You\'re probably using a development version!? ';
            $updateMessage .= $thisVersionString;
        } elseif (is_string($updateMessage) && trim($updateMessage) !== '') {
            $updateMessage .= '<br />';
            $updateMessage .= LocalizationUtility::translate($prefix . 'warning_update_message', $key) . ' ';
            $updateMessage .= $thisVersionString;
        }
        return $updateMessage;
    }
}
