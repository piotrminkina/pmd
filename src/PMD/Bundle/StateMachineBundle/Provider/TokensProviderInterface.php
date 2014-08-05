<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Provider;

use PMD\Bundle\StateMachineBundle\Process\TokenReadInterface;
use PMD\Bundle\StateMachineBundle\Model\StatefulInterface;

/**
 * Interface TokensProviderInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Provider
 */
interface TokensProviderInterface
{
    /**
     * @param StatefulInterface $object
     * @return TokenReadInterface[]
     */
    public function getTokens(StatefulInterface $object);
}
