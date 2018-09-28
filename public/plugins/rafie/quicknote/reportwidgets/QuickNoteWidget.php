<?php namespace RAFIE\Quicknote\ReportWidgets;

use Backend\Classes\ReportWidgetBase;

class QuickNoteWidget extends ReportWidgetBase
{
  protected $defaultAlias = 'quicknotereport';
  public function render(){
    $notes = \BackendAuth::getUser()->notes;
    return $this->makePartial('notes', ['notes' => $notes]);
  }

  public function defineProperties(){
    return [
      'title'     => [
          'title'     => 'Widget title',
          'default'   => 'QUICK NOTE'
      ],
      'showList'  => [
          'title'     => 'Show notes',
          'type'      => 'checkbox'
      ]
    ];
  }
}