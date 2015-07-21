<?php
/**
 * Author: Jean-Baptiste Bouhier
 * Date: 08/07/15
 * Time: 7:35 PM
 */

namespace Mower\Model;


class Gazon
{
    /**
     * @var array(int x, int y)
     */
    protected $rect = array();

    /**
     * Gazon constructor.
     * @param array $rect
     */
    public function __construct(array $rect)
    {
        $this->setRect($rect);
    }

    /**
     * @return array
     */
    public function getRect()
    {
        return $this->rect;
    }

    /**
     * @param array $rect
     */
    public function setRect($rect)
    {
        $this->rect = array('x' => (int) $rect[0], 'y' => (int) $rect[1]);
    }
}