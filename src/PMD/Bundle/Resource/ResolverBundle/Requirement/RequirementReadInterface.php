<?php

/*
 * This file is part of the PMDResourcesResolverBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\ResourcesResolverBundle\Requirement;

/**
 * Interface RequirementReadInterface
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\ResourcesResolverBundle\Requirement
 */
interface RequirementReadInterface
{
    /**
     * @return bool
     */
    public function isOptional();

    /**
     * @return string|null
     */
    public function getClass();

    /**
     * @return string
     */
    public function getResourceName();

    /**
     * @return string
     */
    public function getResolvedName();
}
