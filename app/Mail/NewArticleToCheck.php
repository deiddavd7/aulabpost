<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;

class NewArticleToCheck extends Mailable
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
            subject: 'Nuovo articolo da revisionare'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.new-article-to-check'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

