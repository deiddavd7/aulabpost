<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;

class ArticleRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('hello@aulabpost.it', 'The Aulab Post'),
            subject: 'Il tuo articolo è stato rifiutato'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.article-rejected'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

