<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Provider;

use PMD\StateMachineBundle\Process\TokenReadInterface;
use PMD\StateMachineBundle\Model\StatefulInterface;

/**
 * Interface TokensProviderInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Provider
 */
interface TokensProviderInterface
{
    /**
     * @param StatefulInterface $object
     * @return TokenReadInterface[]
     */
    public function getTokens(StatefulInterface $object);
}
