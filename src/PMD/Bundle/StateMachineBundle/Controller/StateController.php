<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PMD\Bundle\StateMachineBundle\Handler\HandlerInterface;
use PMD\Bundle\StateMachineBundle\Model\StatefulInterface;

/**
 * Class StateController
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Controller
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
