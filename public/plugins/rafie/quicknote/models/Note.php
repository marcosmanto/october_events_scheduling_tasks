<?php namespace RAFIE\Quicknote\Models;

use Model;

/**
 * Note Model
 */
class Note extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'rafie_quicknote_notes';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    protected $rules = [
      'title' => 'required|min:4'
    ];

    protected $throwOnValidation = false;

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
      'user' => ['Backend\Models\User']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
