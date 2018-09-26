<?php namespace October\Demo;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'October Demo',
            'description' => 'Provides features used by the provided demonstration theme.',
            'author'      => 'Alexey Bobkov, Samuel Georges',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerComponents()
    {
        return [
            '\October\Demo\Components\Todo' => 'demoTodo'
        ];
    }

    public function registerSchedule($schedule)
    {
        $schedule->call(function () {
            //\DB::table('marcosmantovani_movies_movies')->delete();
            \Log::info('Running task at '.date("Y-m-d H:i:s"));
        })->everyMinute()->sendOutputTo('/var/www/public/storage/logs/schedule.log');
    }

    public function boot()
    {
        \Event::listen('rainlab.user.login', function ($user) {
            \Log::info('Login usuário: '.$user->name);
        });
        \Event::listen('marcosmantovani.movies.afterCreate', function ($movie) {
            \Log::info('O Filme "' . $movie->name . '" foi criado');
        });
    }
}
