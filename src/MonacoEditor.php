<?php

namespace Spatie\MailcoachMonaco;

use Illuminate\Contracts\View\View;
use Spatie\Mailcoach\Http\App\Livewire\EditorComponent;

class MonacoEditor extends EditorComponent
{
    public function render(): View
    {
        return view('mailcoach-monaco::editor');
    }
}
