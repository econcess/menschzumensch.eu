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

trait Attribute1Trait
{

    /**
     * @var string
     */
    protected string $attribute1 = '';

    /**
     * @return string $attribute1
     */
    public function getAttribute1(): string
    {
        return $this->attribute1;
    }

    /**
     * @param string $attribute1
     */
    public function setAttribute1(string $attribute1)
    {
        $this->attribute1 = $attribute1;
    }
}
