<?php namespace MarcosMantovani\Movies\Models;

use Model;

/**
 * Model
 */
class Movie extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public function afterCreate()
    {
        \Event::fire('marcosmantovani.movies.afterCreate', [$this]);
    }

    /**
     * @var string The database table used by the model.
     */
    public $table = 'marcosmantovani_movies_movies';
}
