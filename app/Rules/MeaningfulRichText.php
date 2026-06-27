<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class MeaningfulRichText implements ValidationRule
{
    /**
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('The :attribute must contain text.');

            return;
        }

        $plainText = html_entity_decode(strip_tags($value), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $plainText = preg_replace('/[\s\x{00A0}]+/u', '', $plainText) ?? '';

        if ($plainText === '') {
            $fail('The :attribute must contain readable text.');
        }
    }
}
