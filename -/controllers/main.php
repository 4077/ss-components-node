<?php namespace ss\components\node\controllers;

class Main extends \Controller
{
    public function __create()
    {
        if ($this->_calledMethodIn('reload')) {
            $this->_dmap('|');
        } else {
            $this->packModels();
            $this->dmap('|');
        }

        $this->unpackModels();
    }

    public function reload()
    {
        $this->jquery('|')->replace($this->view());
    }

    public function view()
    {
        $v = $this->v('|');

        $editable = $this->a('ewma:dev') && ss()->globalEditable(); // запилено на ss

        $s = $this->s('|', [
            'cp' => true,
            'ui' => false
        ]);

        $d = $this->d(false, [
            'ui_render' => true
        ]);

        if (!$editable || ($s['ui'] && $d['ui_render'])) {
            $v->assign('UI', $this->c('ui~:view|', $this->data)->render());
        }

        if ($editable && $s['cp']) {
            $v->assign('CP', $this->c('cp~:view|', $this->data)->render());
        }

        if ($editable) {
            $v->assign('editable');
        }

        list($modulePath, $nodePath) = \ss\components\node\Svc::renderExplodedPath($this->_instance());

        $v->assign([
                       'NODE_URL'  => abs_url('cp/modules/node/?path=' . $modulePath . ' ' . $nodePath),
                       'CP_BUTTON' => $this->c('\std\ui button:view', [
                           'path'    => '>xhr:toggleMode:cp|',
                           'class'   => 'cp button ' . ($s['cp'] ? 'enabled' : ''),
                           'content' => 'cp'
                       ]),
                       'UI_BUTTON' => $this->c('\std\ui button:view', [
                           'path'    => '>xhr:toggleMode:ui|',
                           'class'   => 'ui button ' . ($s['ui'] ? 'enabled' : '') . ' ' . ($d['ui_render'] ? '' : 'globally_disabled'),
                           'content' => 'ui'
                       ])
                   ]);

        $this->css();

        if ($editable) {
            $this->app->html->addCall('ace', '\js\ace~:resizeAll');
        }

        return $v;
    }

    public function uiView()
    {
        return $this->c('ui~:view|', $this->data);
    }
}
