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
 * TODO: Process Instance Data
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Process\Instance
 */
interface ProcessInstanceInterface
{
    /**
     * @param string $state
     * @return ProcessInstanceInterface
     */
    public function setState($state);

    /**
     * @return string
     */
    public function getState();

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
