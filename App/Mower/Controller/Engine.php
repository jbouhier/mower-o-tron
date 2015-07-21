<?php
/**
 * Author: Jean-Baptiste Bouhier
 * Date: 09/07/15
 * Time: 10:41 PM
 */

namespace Mower\Controller;

use Mower\Model\Tondeuse;
use Mower\Model\Gazon;

class Engine
{
    protected $filename;
    protected $gazon;
    protected $tondeuses = array();

    /**
     * Engine constructor.
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->setFilename($filename);
    }

    private function check_read()
    {
        $file = $this->getFilename();
        return is_readable($file);
    }

    private function make_gazon($str)
    {
        preg_match("/\d+ \d+/", $str, $arr);
        $dimensions = explode(' ', $arr[0]);
        $this->setGazon(new Gazon($dimensions));
    }

    private function make_tondeuse($tond_pos, $tond_cmds)
    {
        $pos = array();
        $cmds = array();
        preg_match("/^\d+ \d+ [NEWS]$/i", $tond_pos, $pos);
        preg_match("/^[gad]+$/i", $tond_cmds, $cmds);
        $pos = explode(' ', $pos[0]);
        $cmds = str_split($cmds[0]);
        $this->setTondeuses(new Tondeuse($pos, $cmds));
    }

    private function parse_file($fd)
    {
        $lcount = 1;

        while (($line = fgets($fd)) != false)
        {
            if ($lcount  == 1)
                $this->make_gazon($line);
            else if ($lcount % 2 == 0)
                $tond_pos = $line;
            else
                $tond_seq = $line;

            if (isset($tond_pos) && isset($tond_seq))
            {
                $this->make_tondeuse($tond_pos, $tond_seq);
                unset($tond_pos, $tond_seq);
            }
            $lcount++;
        }
        fclose($fd);
    }

    private function check_fd()
    {
        if (!($fd = fopen($this->getFilename(), 'r')))
        {
            echo "System could not open a File Descriptor on: '" . $this->getFilename() . "'\n";
            die();
        }
        else
            $this->parse_file($fd);
    }

    public function init()
    {
        if ($this->check_read())
            $this->check_fd();
        else
        {
            echo "Can't open: '" . $this->getFilename() . "', check your permissions.\n";
            die();
        }
    }

    public function start()
    {
        foreach ($this->getTondeuses() as  $tond)
        {
            $tond->setGazon($this->getGazon());
            $tond->run();
        }
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return Gazon
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
     * @return array
     */
    public function getTondeuses()
    {
        return $this->tondeuses;
    }

    /**
     * @param Tondeuse $tondeuses
     */
    public function setTondeuses(Tondeuse $tondeuses)
    {
        array_push($this->tondeuses, $tondeuses);
    }
}