<?php

namespace CodingMs\AdditionalTca\Domain\Model\Traits;

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

/**
 * !!! ATTENTION !!!
 * We don't use 'use DateTime;' because sometimes there are issues like:
 *
 * Could not find class definition for name "CodingMs\Modules\Domain\Model\DateTime".
 * This could be caused by a mis-spelling of the class name in the class definition.
 *
 */

trait StarttimeTrait
{

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $starttime = null;

    /**
     * @return \DateTime $starttime
     */
    public function getStarttime(): ?\DateTime
    {
        return $this->starttime;
    }

    /**
     * @param \DateTime $starttime
     */
    public function setStarttime(\DateTime $starttime)
    {
        $this->starttime = $starttime;
    }
}
