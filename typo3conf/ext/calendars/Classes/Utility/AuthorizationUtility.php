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

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;

/**
 * Authorization Tools
 *
 * @package guidelines
 * @subpackage Utility
 *
 * ChangeLog Version: 1.3.0
 * *    [TASK] Refactoring of utility
 *
 * ChangeLog Version: 1.2.0
 * *    [FEATURE] Adding frontendLoginExists method
 *
 * ChangeLog Version: 1.1.0
 * *    [FEATURE] Adding backendAccessiblePages method
 *
 * ChangeLog Version: 1.0.1
 * *    [BUGFIX] Fix backendLoginIsAdmin method
 *
 *
 */
class AuthorizationUtility
{

    /**
     * Checks if a backend user is an admin user
     * @return bool
     */
    public static function backendLoginIsAdmin(): bool
    {
        $isAdmin = false;
        $backendUserAuthentication = self::getBackendUserAuthentication();
        if ($backendUserAuthentication instanceof BackendUserAuthentication) {
            if (is_array($backendUserAuthentication->user)) {
                $isAdmin = (bool)$backendUserAuthentication->user['admin'];
            }
        }
        return $isAdmin;
    }

    /**
     * Checks if a backend user is logged in
     * @return bool
     */
    public static function backendLoginExists(): bool
    {
        $loginExists = false;
        $backendUserAuthentication = self::getBackendUserAuthentication();
        if ($backendUserAuthentication instanceof BackendUserAuthentication) {
            if (is_array($backendUserAuthentication->user)) {
                $loginExists = (bool)$backendUserAuthentication->user['uid'];
            }
        }
        return $loginExists;
    }

    /**
     * Returns accessible pages for current backend user
     * @return array
     */
    public static function backendAccessiblePages($fields = 'uid')
    {
        $pages = [];
        $backendUserAuthentication = self::getBackendUserAuthentication();
        if ($backendUserAuthentication instanceof BackendUserAuthentication) {
            /** @var ConnectionPool $connectionPool */
            $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = $connectionPool->getQueryBuilderForTable('pages');
            $result = $queryBuilder
                ->select($fields)
                ->from('pages')
                ->where($backendUserAuthentication->getPagePermsClause(1))
                ->orderBy('sorting', 'DESC')
                ->execute();
            while ($row = $result->fetch()) {
                $pages[$row['uid']] = $row;
            }
        }
        return $pages;
    }

    /**
     * Get backend user authentication
     * @return \TYPO3\CMS\Core\Authentication\BackendUserAuthentication|null
     */
    public static function getBackendUserAuthentication(): BackendUserAuthentication
    {
        $backendUserAuthentication = null;
        if (isset($GLOBALS['BE_USER'])) {
            $backendUserAuthentication = $GLOBALS['BE_USER'];
        }
        return $backendUserAuthentication;
    }

    /**
     * Frontend user login
     * @param $username string Frontend user username
     * @param $password string Frontend user password
     * @return bool
     */
    public static function frontendUserLogin(string $username, string $password): bool
    {
        /**
         * @todo This method needs to be refactored!
         * @deprecated Deprecated methods in use!
         */
        $success = false;
        $frontendUserAuthentication = self::getFrontendUserAuthentication();
        if ($frontendUserAuthentication instanceof FrontendUserAuthentication) {
            $loginData = [
                'username' => $username,
                'uident_text' => $password,
                'status' => 'login',
            ];
            $frontendUserAuthentication->checkPid = ''; //do not use a particular pid
            $info = $frontendUserAuthentication->getAuthInfoArray();
            $user = $frontendUserAuthentication->fetchUserRecord($info['db_user'], $loginData['username']);
            if ($frontendUserAuthentication->compareUident($user, $loginData)) {
                $frontendUserAuthentication->createUserSession($user);
                $success = true;
            }
        }
        return $success;
    }

    /**
     * Frontend user logout
     */
    public static function frontendUserLogout()
    {
        $frontendUserAuthentication = self::getFrontendUserAuthentication();
        if ($frontendUserAuthentication instanceof FrontendUserAuthentication) {
            $frontendUserAuthentication->logoff();
        }
    }

    /**
     * Checks if a frontend user is logged in
     * @return boolean
     */
    public static function frontendLoginExists()
    {
        $frontendLoginExists = false;
        $frontendUserAuthentication = self::getFrontendUserAuthentication();
        if ($frontendUserAuthentication instanceof FrontendUserAuthentication) {
            $frontendLoginExists = isset($frontendUserAuthentication->user['username']);
        }
        return $frontendLoginExists;
    }

    /**
     * Get frontend user authentication
     * @return \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication|null
     */
    public static function getFrontendUserAuthentication(): FrontendUserAuthentication
    {
        $frontendUserAuthentication = null;
        if (isset($GLOBALS['TSFE'])) {
            if (isset($GLOBALS['TSFE']->fe_user)) {
                $frontendUserAuthentication = $GLOBALS["TSFE"]->fe_user;
            }
        }
        return $frontendUserAuthentication;
    }

}
