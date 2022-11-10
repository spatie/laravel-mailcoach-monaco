<?php

namespace Spatie\MailcoachMonaco;

use Illuminate\Support\ServiceProvider;

class MailcoachMonacoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mailcoach-monaco');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/mailcoach/monaco'),
            ], 'mailcoach-monaco-views');

            $this->publishes([
                __DIR__.'/../resources/monaco' => public_path('vendor/mailcoach/monaco/vs'),
            ], 'mailcoach-monaco-assets');
        }
    }
}
