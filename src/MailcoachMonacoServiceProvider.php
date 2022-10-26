<?php

namespace Spatie\MailcoachMonaco;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Spatie\Mailcoach\Mailcoach;

class MailcoachMonacoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/mailcoach-monaco.php', 'mailcoach-monaco');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mailcoach-monaco');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/mailcoach/monaco'),
            ], 'mailcoach-monaco-views');
        }

        Livewire::component('mailcoach-monaco::editor', MonacoEditor::class);

        Mailcoach::editorScript(MonacoEditor::class, 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.21.2/min/vs/loader.min.js');
    }
}
