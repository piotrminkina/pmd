<?php

namespace PMD\ResourcesResolverBundle\Requirement;

/**
 * Interface RequirementReaderInterface
 * @package PMD\ResourcesResolverBundle\Requirement
 */
interface RequirementReaderInterface
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
    public function getName();
}
