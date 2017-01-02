<?php

namespace Ferrl\Support\Utils;

use Illuminate\Support\MessageBag;
use InvalidArgumentException;

/**
 * App\View\FlashMessages.
 *
 * @method void success($message)
 * @method void info($message)
 * @method void warning($message)
 */
class FlashMessages
{
    /**
     * Types of flash messages.
     *
     * @var array
     */
    protected $types = ['success', 'info', 'warning'];

    /**
     * Returns the types property.
     *
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Pushes a new message into one of the bags.
     *
     * @param string $key
     * @param string $message
     */
    protected function pushToBag($key, $message)
    {
        /** @var MessageBag $bag */
        $bag = session()->get('flashes.'.$key, new MessageBag);
        $bag->add(uniqid(), $message);

        session()->flash('flashes.'.$key, $bag);
    }

    /**
     * Push a message to one of the defined bags.
     *
     * @param string $method
     * @param array $params
     */
    public function __call($method, $params)
    {
        if (! in_array($method, $this->getTypes())) {
            throw new InvalidArgumentException('Message bag does not exist.');
        }

        if (! (isset($params[0]) && is_string($params[0]))) {
            throw new InvalidArgumentException('Must pass two string parameters.');
        }

        $this->pushToBag($method, $params[0]);
    }
}
