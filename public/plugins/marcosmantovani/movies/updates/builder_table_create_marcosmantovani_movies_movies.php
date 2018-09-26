<?php namespace MarcosMantovani\Movies\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMarcosmantovaniMoviesMovies extends Migration
{
    public function up()
    {
        Schema::create('marcosmantovani_movies_movies', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('marcosmantovani_movies_movies');
    }
}
