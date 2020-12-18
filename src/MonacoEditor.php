<?php

namespace Spatie\MailcoachMonaco;

use Spatie\Mailcoach\Domain\Campaign\Models\Concerns\HasHtmlContent;
use Spatie\Mailcoach\Domain\Campaign\Support\Editor\Editor;

class MonacoEditor implements Editor
{
    public function render(HasHtmlContent $model): string
    {
        return view('mailcoach-monaco::editor', [
            'html' => $model->getHtml(),
        ])->render();
    }
}
