<?php namespace October\Demo\Controllers;

class Todos extends \Backend\Classes\Controller {
  public function index(){
    $this->vars['testVar'] = $this;
    $this->vars['action'] = $this->action;
    $this->pageTitle = '[Todos]';
  }

  public function add(){

  }

  public function onDoSomething(){
    
    $this->vars['foo'] = 'bar';

    return [
        'test' => "OK"
    ];
  }
}
