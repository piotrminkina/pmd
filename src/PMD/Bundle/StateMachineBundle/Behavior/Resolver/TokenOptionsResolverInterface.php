<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Behavior\Resolver;

use PMD\StateMachineBundle\Process\TokenInterface;

/**
 * Interface TokenOptionsResolverInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Behavior\Resolver
 */
interface TokenOptionsResolverInterface
{
    /**
     * @param TokenInterface $token
     * @return array
     */
    public function resolveOptions(TokenInterface $token);
}
