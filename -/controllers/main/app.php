<?php namespace ss\components\node\controllers\main;

class App extends \Controller
{
    public function toggleUiRender()
    {
        $uiOutput = &$this->d('~:ui_render');

        invert($uiOutput);

        return $uiOutput ? 'enabled' : 'disabled';
    }
}
