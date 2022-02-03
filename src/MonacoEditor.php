<?php

namespace Spatie\MailcoachMonaco;

use Spatie\Mailcoach\Domain\Campaign\Models\Concerns\HasHtmlContent;
use Spatie\Mailcoach\Domain\Campaign\Models\Template;
use Spatie\Mailcoach\Domain\Shared\Support\Editor\Editor;
use Spatie\Mailcoach\Domain\TransactionalMail\Models\TransactionalMailTemplate;

class MonacoEditor implements Editor
{
    public function render(HasHtmlContent $model): string
    {
        return view('mailcoach-monaco::editor', [
            'html' => $model->getHtml(),
            'showTestButton' => ! $model instanceof Template && ! $model instanceof TransactionalMailTemplate,
        ])->render();
    }
}
