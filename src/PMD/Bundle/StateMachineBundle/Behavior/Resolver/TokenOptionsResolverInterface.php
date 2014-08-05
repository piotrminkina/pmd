<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Behavior\Resolver;

use PMD\Bundle\StateMachineBundle\Process\TokenInterface;

/**
 * Interface TokenOptionsResolverInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Behavior\Resolver
 */
interface TokenOptionsResolverInterface
{
    /**
     * @param TokenInterface $token
     * @return array
     */
    public function resolveOptions(TokenInterface $token);
}
