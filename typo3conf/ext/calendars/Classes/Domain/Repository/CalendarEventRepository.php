<?php

namespace CodingMs\Calendars\Domain\Repository;

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

use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use TYPO3\CMS\Extbase\Persistence\Repository;
use CodingMs\Calendars\Domain\Model\CalendarEventCategory;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Event repository
 *
 * @package calendars
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CalendarEventRepository extends Repository
{

    /**
     * @param \CodingMs\Calendars\Domain\Model\CalendarEventCategory|null $category Selected category or null
     * @param \CodingMs\AddressManager\Domain\Model\Address|null $address Selected address or null
     * @param int $firstDayOfYear Date from
     * @param int $lastDayOfYear Date to
     * @param string $order Sorting order ASC or DESC
     * @param int $limit Limit of event items
     * @return array|object|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findAllByFilter($category = null, $address = null, $firstDayOfYear, $lastDayOfYear, $order = 'ASC', $limit = 0)
    {
        $query = $this->createQuery();
        //$query->getQuerySettings()->setRespectStoragePage(false);
        $constraints = [];
        //
        if($category instanceof QueryResult) {
            $category = $category->toArray();
        }
        if(is_array($category)) {
            if(count($category) > 1) {
                $constraints[] = $query->in('calendarEventCategory', $category);
            }
            else {
                $constraints[] = $query->contains('calendarEventCategory', $category[0]);
            }
        }
        else if ($category instanceof CalendarEventCategory)  {
            $constraints[] = $query->contains('calendarEventCategory', $category);
        }
        if ($address instanceof \CodingMs\AddressManager\Domain\Model\Address) {
            $constraints[] = $query->equals('address', $address);
        }
        // Only in date period
        // Beginning must be in start/end period
        $constraintsStart = [];
        $constraintsStart[] = $query->greaterThanOrEqual('start_date', $firstDayOfYear);
        $constraintsStart[] = $query->lessThanOrEqual('start_date', $lastDayOfYear);
        // Ending must be in start/end period
        $constraintsEnd = [];
        $constraintsEnd[] = $query->greaterThanOrEqual('end_date', $firstDayOfYear);
        $constraintsEnd[] = $query->lessThanOrEqual('end_date', $lastDayOfYear);
        // Combine constraints
        $constraintsStartEnd = [];
        $constraintsStartEnd[] = $query->logicalAnd($constraintsStart);
        $constraintsStartEnd[] = $query->logicalAnd($constraintsEnd);
        $constraints[] = $query->logicalOr($constraintsStartEnd);
        $query->matching(
            $query->logicalAnd($constraints)
        );
        // Sort by start date
        if ($order == 'ASC') {
            $query->setOrderings(['start_date' => QueryInterface::ORDER_ASCENDING]);
        } else {
            $query->setOrderings(['start_date' => QueryInterface::ORDER_DESCENDING]);
        }
        // Use the limit, if available
        if ($limit > 0) {
            $query->setLimit($limit);
            return $query->execute()->getFirst();
        } else {
            return $query->execute();
        }
    }

    /**
     * Find all Events in future
     *
     * @param \CodingMs\Calendars\Domain\Model\CalendarEventCategory $category Selected category or null
     * @param \CodingMs\AddressManager\Domain\Model\Address $category Selected address or null
     * @param int $offset Offset
     * @param int $limit Limit
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     */
    public function findAllInFuture($category = null, $address = null, $offset = 0, $limit = 0)
    {
        $query = $this->createQuery();
        $constraints = [];
        //
        if($category instanceof QueryResult) {
            $category = $category->toArray();
        }
        if(is_array($category)) {
            if(count($category) > 1) {
                $constraints[] = $query->in('calendarEventCategory', $category);
            }
            else {
                $constraints[] = $query->contains('calendarEventCategory', $category[0]);
            }
        }
        else if ($category instanceof CalendarEventCategory)  {
            $constraints[] = $query->contains('calendarEventCategory', $category);
        }
        //
        if ($address instanceof \CodingMs\AddressManager\Domain\Model\Address) {
            $constraints[] = $query->equals('address', $address);
        }
        // Da das end_date der Tag des Termins um 0 Uhr morgens ist,
        // ziehen wir 24 Std - 1 Sek ab
        $constraints[] = $query->greaterThanOrEqual('end_date', time() - (60 * 60 * 24) - 1);

        $query->matching(
            $query->logicalAnd($constraints)
        );


        $query->setOrderings(['end_date' => QueryInterface::ORDER_ASCENDING]);
        if ($limit > 0) {
            $query->setLimit($limit);
        }
        if ($offset > 0) {
            $query->setOffset($offset);
        }
        return $query->execute();
    }

    /**
     * @param null $address
     * @param int $offset
     * @param int $limit
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findAllByAddressInFuture($address = null, $offset = 0, $limit = 15)
    {
        $query = $this->createQuery();
        $constraints = [];
        //
        if ($address instanceof \CodingMs\AddressManager\Domain\Model\Address) {
            $constraints[] = $query->equals('address', $address);
        }

        // Da das end_date der Tag des Termins um 0 Uhr morgens ist,
        // ziehen wir 24 Std - 1 Sek ab
        $constraints[] = $query->greaterThanOrEqual('end_date', time() - (60 * 60 * 24) - 1);

        $query->matching(
            $query->logicalAnd($constraints)
        );
        $query->setOrderings(['end_date' => QueryInterface::ORDER_ASCENDING]);
        //
        if ($limit > 0) {
            $query->setLimit($limit);
        }
        if ($offset > 0) {
            $query->setOffset($offset);
        }
        return $query->execute();
    }

    /**
     * @param array $filter
     * @param boolean $count
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface|int
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findAllForBackendList(array $filter = array(), $count = false)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true);
        $query->getQuerySettings()->setRespectStoragePage(true);
        // category filter
        $constraints = array();
        if ($filter['category']['selected'] > 0) {
            $constraints[] = $query->contains('calendarEventCategory', $filter['category']['selected']);
        }
        $query->matching($constraints[0]);
        // end category filter
        if (!$count) {
            if (isset($filter['sortingField']) && $filter['sortingField'] !== '') {
                if ($filter['sortingOrder'] === 'asc') {
                    $query->setOrderings(array($filter['sortingField'] => QueryInterface::ORDER_ASCENDING));
                } else {
                    if ($filter['sortingOrder'] === 'desc') {
                        $query->setOrderings(array($filter['sortingField'] => QueryInterface::ORDER_DESCENDING));
                    }
                }
            }
            if ((int)$filter['limit'] > 0) {
                $query->setOffset((int)$filter['offset']);
                $query->setLimit((int)$filter['limit']);
            }
            return $query->execute();
        } else {
            return $query->execute()->count();
        }
    }

    /**
     * @param array $filter
     * @param boolean $count
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface|int
     */
    public function findAllForFrontendList(array $filter = [], $count = false)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true);
        $query->getQuerySettings()->setRespectStoragePage(true);
        $constraints = [];
        $constraints[] = $query->equals('frontendUser', $filter['frontendUser']->getUid());
        $query->matching($constraints[0]);
        if (!$count) {
            if (isset($filter['sortingField']) && $filter['sortingField'] !== '') {
                if ($filter['sortingOrder'] === 'asc') {
                    $query->setOrderings([$filter['sortingField'] => QueryInterface::ORDER_ASCENDING]);
                } else {
                    if ($filter['sortingOrder'] === 'desc') {
                        $query->setOrderings([$filter['sortingField'] => QueryInterface::ORDER_DESCENDING]);
                    }
                }
            }
            if ((int)$filter['limit'] > 0) {
                $query->setOffset((int)$filter['offset']);
                $query->setLimit((int)$filter['limit']);
            }
            return $query->execute();
        } else {
            return $query->execute()->count();
        }
    }

    /**
     * @param int $uid
     * @return object
     */
    public function findByIdentifierFrontend(int $uid, int $frontendUser)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true);
        $query->getQuerySettings()->setRespectStoragePage(true);
        $constraints = [];
        $constraints[] = $query->equals('uid', $uid);
        $constraints[] = $query->equals('frontendUser', $frontendUser);
        $query->matching($query->logicalAnd($constraints));
        return $query->execute()->getFirst();
    }

}
