<?php namespace ss\components\node\controllers\main;

class Xhr extends \Controller
{
    public $allow = self::XHR;

    public function toggleMode($type)
    {
        $s = &$this->s('~|');

        invert($s[$type]);

        $this->c('~:reload|');
    }
}
