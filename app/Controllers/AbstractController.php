<?php

namespace PremierNewsletter\Controllers;

abstract class AbstractController
{
    private $_panelUrl;

    public function setPanelUrl($panelUrl){
        return $this->_panelUrl = $panelUrl;
    }

    public function getPanelUrl(){
        return $this->_panelUrl;
    }
}
