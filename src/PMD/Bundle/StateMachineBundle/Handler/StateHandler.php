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

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use PMD\StateMachineBundle\Model\StatefulInterface;

/**
 * Class StateHandler
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Handler
 */
class StateHandler implements HandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handle(
        Request $request,
        StatefulInterface $object,
        $action
    ) {
        return new Response($action);
    }
}
