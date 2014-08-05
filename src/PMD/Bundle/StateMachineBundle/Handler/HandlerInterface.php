<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PMD\Bundle\StateMachineBundle\Model\StatefulInterface;

/**
 * Interface HandlerInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Handler
 */
interface HandlerInterface
{
    /**
     * @param Request $request
     * @param StatefulInterface $object
     * @return mixed|Response
     */
    public function handle(Request $request, StatefulInterface $object);
}
