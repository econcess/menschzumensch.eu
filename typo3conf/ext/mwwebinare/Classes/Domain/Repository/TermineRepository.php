<?php
namespace Mwwebinare\Mwwebinare\Domain\Repository;

/***
 *
 * This file is part of the "Infoniqa Webinare" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Martin Weymayer <office@weymayer.at>, Webagentur Weymayer
 *
 ***/

/**
 * The repository for Termines
 */
class TermineRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = [
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    ];
	
	public function findAllWeitereTermine($webinare = 1, $termine) {
		

		$query = $this->createQuery();
		$query->setOrderings(array("beginn" => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
		#$query->getQuerySettings()->setRespectStoragePage(FALSE);
		
		$constraints = array();
		
		$constraints[] = $query->equals('webinare', $webinare);
		$constraints[] = $query->greaterThan('beginn', time());
		
		$constraintsAndThenOrKategorien2 = $query->logicalAnd($query->equals('uid', $termine));
		$constraints[] = $query->logicalNot($constraintsAndThenOrKategorien2);
				
		
		$result = $query->matching($query->logicalAnd($constraints))
		->execute();


		return $result;
		
		
	}
}
