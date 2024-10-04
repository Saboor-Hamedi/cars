<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ChatbotServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $queries;

    public function __construct($app)
    {

        parent::__construct($app);
    }
    public function register(): void
    {
        $this->app->bind('chatbot.queries', function ($app) {
            return require app_path('Livewire/Chat/chatbot_queries.php');
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // $this->queries = require app_path('Livewire/Chat/chatbot_queries.php');

    }
    public function getQueries()
    {
        return $this->queries;
    }
}
