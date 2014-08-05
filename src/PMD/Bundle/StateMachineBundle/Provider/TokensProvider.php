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

use Symfony\Component\HttpFoundation\RequestStack;
use PMD\Bundle\StateMachineBundle\Process\TokenReadInterface;
use PMD\Bundle\StateMachineBundle\Model\StatefulInterface;
use PMD\Bundle\StateMachineBundle\FactoryInterface;

/**
 * Class TokensProvider
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Provider
 */
class TokensProvider implements TokensProviderInterface
{
    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @var RequestStack
     */
    protected $stack;

    /**
     * @var string
     */
    protected $processPath;

    /**
     * @param FactoryInterface $factory
     * @param RequestStack $stack
     */
    public function __construct(FactoryInterface $factory, RequestStack $stack)
    {
        $this->factory = $factory;
        $this->stack = $stack;
    }

    /**
     * @param string $processPath
     * @return TokensProvider
     */
    public function setProcessPath($processPath)
    {
        $this->processPath = $processPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getProcessPath()
    {
        return $this->processPath;
    }

    /**
     * @param StatefulInterface $object
     * @return TokenReadInterface[]
     */
    public function getTokens(StatefulInterface $object)
    {
        $request = $this->stack->getCurrentRequest();
        $process = $request->attributes->get($this->processPath, null, true);
        $stateMachine = $this->factory->create($process, $object);

        return $stateMachine->getTokens();
    }
}
