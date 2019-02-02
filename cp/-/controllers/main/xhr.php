<?php namespace ss\components\node\cp\controllers\main;

class Xhr extends \Controller
{
    public $allow = self::XHR;

    public function updateHeight()
    {
        $this->s('~:height|', $this->data('height'), RA);

        $this->c('\js\ace~:resizeAll');
    }
}
