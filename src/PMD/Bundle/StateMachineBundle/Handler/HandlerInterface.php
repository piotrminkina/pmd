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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PMD\StateMachineBundle\Model\StatefulInterface;

/**
 * Interface HandlerInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Handler
 */
interface HandlerInterface
{
    /**
     * @param Request $request
     * @param StatefulInterface $object
     * @param string $action
     * @return mixed|Response
     */
    public function handle(
        Request $request,
        StatefulInterface $object,
        $action
    );
}
