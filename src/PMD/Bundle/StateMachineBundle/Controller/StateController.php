<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PMD\StateMachineBundle\Handler\HandlerInterface;
use PMD\StateMachineBundle\Model\StatefulInterface;

/**
 * Class StateController
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Controller
 */
class StateController
{
    /**
     * @var HandlerInterface
     */
    protected $handler;

    /**
     * @param HandlerInterface $handler
     */
    public function __construct(HandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param Request $request
     * @param StatefulInterface $object
     * @return mixed|Response
     */
    public function handleAction(Request $request, StatefulInterface $object)
    {
        return $this->handler->handle($request, $object);
    }
}
