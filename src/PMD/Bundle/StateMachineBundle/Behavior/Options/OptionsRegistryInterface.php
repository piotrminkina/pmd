<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Behavior\Options;

/**
 * Interface OptionsRegistryInterface
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Behavior\Options
 */
interface OptionsRegistryInterface
{
    /**
     * @param string $key
     * @param array $options
     * @return $this
     */
    public function set($key, array $options);

    /**
     * @param string $key
     * @param array $options
     * @return $this
     */
    public function add($key, array $options);

    /**
     * @param string $key
     * @return array
     */
    public function get($key);

    /**
     * @param string $key
     * @return boolean
     */
    public function has($key);
}
