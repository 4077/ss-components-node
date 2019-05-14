<?php namespace ss\components\node\cp\controllers;

class Main extends \Controller
{
    public function reload()
    {
        $this->jquery('|')->replace($this->view());
    }

    public function view()
    {
        $v = $this->v('|');

        $s = $this->s('|', [
            'height' => false
        ]);

        $this->packModels();

        list($modulePath, $nodePath) = \ss\components\node\Svc::renderExplodedPath($this->_instance());

        if ($modulePath) {
            if (!$this->app->modules->getByPath($modulePath)) {
                $this->c('\ewma\dev~:createModule', [
                    'path'  => $modulePath,
                    'reset' => true
                ]);
            }

            $v->assign([
                           'CONTENT' => $this->c('\ewma\dev\ui\node~:view|' . $this->_nodeInstance(), [
                               'module_path' => $modulePath,
                               'node_path'   => $nodePath,
                               'callbacks'   => [
                                   'reload'     => $this->_abs(':onNodeReload|', $this->data),
                                   'update'     => $this->_abs(':onUpdate|', $this->data),
                                   'typeSelect' => $this->_abs(':onTypeSelect|', $this->data),
                               ]
                           ])
                       ]);
        }

        $this->css();

        $this->widget(':|', [
            'resizableClosestSelector' => '.ui-dialog'
        ]);

        return $v;
    }

    public function onNodeReload()
    {
//        $this->unpackModels();

//        $this->widget(':|', 'setHeight', $this->s(':height|'));
//        $this->widget(':|', 'bindResizable');
    }

    public function onUpdate()
    {
//        $this->unpackModels();
//
        $this->c('@ui~:reload|', $this->data);
    }

    public function onTypeSelect()
    {
//        $this->unpackModels();
//
//        $this->c('@ui~:reload|', $this->data);
    }
}
