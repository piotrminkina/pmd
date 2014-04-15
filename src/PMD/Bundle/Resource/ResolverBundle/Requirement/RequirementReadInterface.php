<?php

namespace PMD\ResourcesResolverBundle\Requirement;

/**
 * Interface RequirementReadInterface
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
