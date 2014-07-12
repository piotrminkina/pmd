<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\Process\Instance;

use PMD\WorkflowBundle\Process\ProcessInterface;

/**
 * The representation of a single enactment of a process.
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Process\Instance
 */
interface ProcessInstanceInterface
{
    /**
     * @param ProcessInterface $process
     * @return ProcessInstanceInterface
     */
    public function setProcess(ProcessInterface $process);

    /**
     * @return ProcessInstanceInterface
     */
    public function getProcess();
}
