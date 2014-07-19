<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Handler;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use PMD\StateMachineBundle\Model\StatefulInterface;
use PMD\StateMachineBundle\FactoryInterface;

/**
 * Class StateHandler
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Handler
 */
class StateHandler implements HandlerInterface
{
    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @var string
     */
    protected $processPath;

    /**
     * @var string
     */
    protected $actionPath;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param string $processPath
     * @return StateHandler
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
     * @param string $actionPath
     * @return StateHandler
     */
    public function setActionPath($actionPath)
    {
        $this->actionPath = $actionPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getActionPath()
    {
        return $this->actionPath;
    }

    /**
     * @inheritdoc
     */
    public function handle(Request $request, StatefulInterface $object)
    {
        $process = $request->attributes->get($this->processPath, null, true);
        $action = $request->attributes->get($this->actionPath, null, true);

        $stateMachine = $this->factory->create($process, $object);

        if (!$stateMachine->hasPossibleTransition($action)) {
            throw new HttpException(404, 'Action not found');
        }
        $stateMachine->flowBy($action);

        return new Response($process . ':' . $action);
    }
}
