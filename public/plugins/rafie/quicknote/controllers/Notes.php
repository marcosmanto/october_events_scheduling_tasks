<?php namespace RAFIE\Quicknote\Controllers;

use BackendMenu;
use Rafie\Quicknote\Models\Note;
use Backend\Classes\Controller;

/**
 * Notes Back-end Controller
 */
class Notes extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'Manage Quick Notes';

        BackendMenu::setContext('RAFIE.Quicknote', 'quicknote', 'notes');
    }

    public function store(){
      $note = new Note;
      $note->title = \Input::get('title');
      $note->description = \Input::get('description');
      $note->user_id = \BackendAuth::getUser()->id;

      if($note->save()){
        \Flash::success('Note added successfully.');
      } else {
        $messages = array_flatten( $note->errors()->getMessages() );
        $errors = implode( ' - ', $messages );
        \Flash::error('Validation error: ' . $errors);
      }

      return \Redirect::to(\Backend::url());

    }

    public function formBeforeCreate($model){
      $model->user_id = \BackendAuth::getUser()->id;
    }

    public function listExtendQueryBefore($query){
      $user_id = \BackendAuth::getUser()->id;
      $query->where('user_id', '=', $user_id);
    }

    public function listOverrideColumnValue($record, $columnName){
      if( $columnName == "description" && empty($record->description) )
             return "[EMPTY]";
    }

    public function listExtendColumns($list){
      $list->addColumns([
          'action' => [
              'label'     => 'Actions',
              'sortable'  => false
          ]
      ]);
    }

    public function update($recordId, $context = null){
      //some code here
      return $this->asExtension('FormController')->update($recordId, $context);
    }

    public function onDelete(){
      //////////////////////////////////////
      /// Funciona sem utilizar este método, porém sobrescrevi
      /// apenas para mostrar a programação por trás do mecanismo do framework
      $user_id = \BackendAuth::getUser()->id;
      $notes = post("checked");
      // dump($user_id, Note::whereIn('id', $notes)->lists('title'));
      Note::whereIn('id', $notes)->where('user_id', '=', $user_id)->delete();
      \Flash::success('Notes Successfully deleted.');
      return $this->listRefresh();
    }
}
