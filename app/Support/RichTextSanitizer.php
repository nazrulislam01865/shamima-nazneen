<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;
use Illuminate\Support\Str;

final class RichTextSanitizer
{
    private const ALLOWED_TAGS = [
        'p', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'blockquote',
        'ul', 'ol', 'li', 'h2', 'h3', 'h4', 'a', 'span', 'figure', 'figcaption', 'img',
    ];

    private const ALLOWED_ATTRIBUTES = [
        'a' => ['href', 'target', 'rel'],
        'span' => [],
        'figure' => ['class'],
        'figcaption' => [],
        'img' => ['src', 'alt', 'title', 'loading', 'class'],
    ];

    public static function clean(?string $html): ?string
    {
        if (blank($html)) {
            return null;
        }

        $document = new DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML(
            '<?xml encoding="utf-8" ?><div id="content-root">'.$html.'</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $root = $document->getElementById('content-root');

        if (! $root) {
            return strip_tags($html);
        }

        self::sanitizeChildren($root);

        $clean = '';
        foreach ($root->childNodes as $child) {
            $clean .= $document->saveHTML($child);
        }

        return trim($clean);
    }

    private static function sanitizeChildren(DOMNode $parent): void
    {
        foreach (iterator_to_array($parent->childNodes) as $node) {
            if ($node instanceof DOMElement) {
                $tag = strtolower($node->tagName);

                if (! in_array($tag, self::ALLOWED_TAGS, true)) {
                    if (in_array($tag, ['script', 'style', 'iframe', 'object', 'embed', 'svg', 'math'], true)) {
                        $node->parentNode?->removeChild($node);
                        continue;
                    }

                    self::sanitizeChildren($node);
                    self::unwrap($node);
                    continue;
                }

                foreach (iterator_to_array($node->attributes) as $attribute) {
                    $allowed = self::ALLOWED_ATTRIBUTES[$tag] ?? [];
                    if (! in_array(strtolower($attribute->name), $allowed, true)) {
                        $node->removeAttribute($attribute->name);
                    }
                }

                if ($tag === 'a') {
                    $href = trim($node->getAttribute('href'));
                    if (str_starts_with($href, '//') || ! preg_match('~^(https?://|mailto:|tel:|/)~i', $href)) {
                        $node->removeAttribute('href');
                    } else {
                        $node->setAttribute('rel', 'noopener noreferrer');
                        if (Str::startsWith($href, ['http://', 'https://'])) {
                            $node->setAttribute('target', '_blank');
                        }
                    }
                }

                if ($tag === 'img') {
                    $src = trim($node->getAttribute('src'));
                    if (str_starts_with($src, '//') || ! preg_match('~^(https?://|/)~i', $src)) {
                        $node->parentNode?->removeChild($node);
                        continue;
                    }

                    $node->setAttribute('loading', 'lazy');
                    $node->setAttribute('class', 'content-image');
                }

                if ($tag === 'figure') {
                    $node->setAttribute('class', 'content-figure');
                }
            }

            self::sanitizeChildren($node);
        }
    }

    private static function unwrap(DOMElement $element): void
    {
        $parent = $element->parentNode;
        if (! $parent) {
            return;
        }

        while ($element->firstChild) {
            $parent->insertBefore($element->firstChild, $element);
        }

        $parent->removeChild($element);
    }
}
