<?php

namespace Spatie\MailcoachMonaco;

use Spatie\Mailcoach\Models\Concerns\HasHtmlContent;
use Spatie\Mailcoach\Support\Editor\Editor;

class MonacoEditor implements Editor
{
    public function render(HasHtmlContent $model): string
    {
        return view('mailcoach-monaco::editor', [
            'html' => $model->getHtml(),
        ])->render();
    }
}
