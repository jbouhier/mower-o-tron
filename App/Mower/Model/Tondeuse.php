<?php
/**
 * Author: Jean-Baptiste Bouhier
 * Date: 08/07/15
 * Time: 7:28 PM
 */

namespace Mower\Model;


class Tondeuse
{
    protected $pos = array();
    protected $cmds = array();
    protected $gazon;

    /**
     * Tondeuse constructor.
     * @param array $pos
     * @param array $cmds
     */
    public function __construct(array $pos, array $cmds)
    {
        $this->setPos($pos);
        $this->setCmds($cmds);
    }

    private function up()
    {
        if ($this->getGazon()->getRect()['y'] + 1 > $this->getGazon()->getRect()['y'])
            $this->setPosY($this->getPosY() + 1);
    }

    private function down()
    {
        if ($this->getPosY() - 1 >= 0)
            $this->setPosY($this->getPosY() - 1);
    }

    private function left()
    {
        if ($this->getPosX() - 1 >= 0)
            $this->setPosX($this->getPosX() - 1);
    }

    private function right()
    {
        if ($this->getGazon()->getRect()['x'] + 1 > $this->getGazon()->getRect()['x'])
            $this->setPosX($this->getPosX() + 1);
    }

    private function avancer()
    {
        $dir = $this->getPosDir();
        if ($dir == 'N')
            $this->up();
        else if ($dir == 'S')
            $this->down();
        else if ($dir == 'W')
            $this->left();
        else if ($dir == 'E')
            $this->right();
    }

    private function gauche()
    {
        if ($this->getPosDir() == 'N')
            $this->setPosDir('W');
        else if ($this->getPosDir() == 'W')
            $this->setPosDir('S');
        else if ($this->getPosDir() == 'S')
            $this->setPosDir('E');
        else if ($this->getPosDir() == 'E')
            $this->setPosDir('N');
    }

    private function droite()
    {
        if ($this->getPosDir() == 'N')
            $this->setPosDir('E');
        else if ($this->getPosDir() == 'E')
            $this->setPosDir('S');
        else if ($this->getPosDir() == 'S')
            $this->setPosDir('W');
        else if ($this->getPosDir() == 'W')
            $this->setPosDir('N');
    }

    public function run()
    {
        foreach ($this->getCmds() as $cmd)
        {
            switch ($cmd)
            {
                case 'A':
                    $this->avancer();
                    break;
                case 'G':
                    $this->gauche();
                    break;
                case 'D':
                    $this->droite();
                    break;
                default:
                    echo "Unkown command, abort mission !\n";
                    die();
            }
        }
        $pos = $this->getPos();
        echo $pos['x'] . " " . $pos['y'] . " " . $pos['d'] . "\n";
    }

    /**
     * @return mixed
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * @param mixed $pos
     */
    public function setPos($pos)
    {
        $this->pos = array('x' => (int) $pos[0], 'y' => (int) $pos[1], 'd' => $pos[2]);
    }

    /**
     * @return mixed
     */
    public function getCmds()
    {
        return $this->cmds;
    }

    /**
     * @param mixed $cmds
     */
    public function setCmds($cmds)
    {
        $this->cmds = $cmds;
    }

    /**
     * @return mixed
     */
    public function getGazon()
    {
        return $this->gazon;
    }

    /**
     * @param Gazon $gazon
     */
    public function setGazon(Gazon $gazon)
    {
        $this->gazon = $gazon;
    }

    /**
     * @return integer
     */
    public function getPosX()
    {
        return $this->pos['x'];
    }

    /**
     * @param int $x
     */
    public function setPosX($x)
    {
        $this->pos['x'] = $x;
    }

    /**
     * @return integer
     */
    public function getPosY()
    {
        return $this->pos['y'];
    }

    /**
     * @param int $y
     */
    public function setPosY($y)
    {
        $this->pos['y'] = $y;
    }

    /**
     * @return string
     */
    public function getPosDir()
    {
        return $this->pos['d'];
    }

    /**
     * @param string $d
     */
    public function setPosDir($d)
    {
        $this->pos['d'] = $d;
    }
}