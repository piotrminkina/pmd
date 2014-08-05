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
 * Class OptionsRegistry
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Behavior\Options
 */
class OptionsRegistry implements OptionsRegistryInterface
{
    /**
     * @var array[]
     */
    protected $options;

    /**
     * @inheritdoc
     */
    public function set($key, array $options)
    {
        $this->options[$key] = $options;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function add($key, array $options)
    {
        // throw exception if key exists

        $this->options[$key] = $options;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function get($key)
    {
        return $this->options[$key];
    }

    /**
     * @inheritdoc
     */
    public function has($key)
    {
        return isset($this->options[$key]);
    }
}
