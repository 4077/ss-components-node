<?php namespace ss\components\node\ui\controllers;

class Main extends \Controller
{
    public function reload()
    {
        $this->jquery('|')->replace($this->view());
    }

    public function view()
    {
        $v = $this->v('|');

        list($modulePath, $nodePath) = \ss\components\node\Svc::renderExplodedPath($this->_instance());

        if ($modulePath) {
            $v->assign([
                           'CONTENT' => $this->c('/' . $modulePath . ' ' . $nodePath . ':view|', $this->data)
                       ]);
        }

        $this->css();

        return $v;
    }
}
