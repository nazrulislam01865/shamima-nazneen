<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class SafeUrl implements ValidationRule
{
    /**
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === null || $value === '') {
            return;
        }

        if (! is_string($value)) {
            $fail('Enter a valid link. Use a complete website URL, a page path, or a page section.');

            return;
        }

        $value = trim($value);
        $isInternal = (str_starts_with($value, '/') && ! str_starts_with($value, '//'))
            || str_starts_with($value, '#');
        $isExternal = filter_var($value, FILTER_VALIDATE_URL)
            && in_array(strtolower((string) parse_url($value, PHP_URL_SCHEME)), ['http', 'https'], true);

        if (! $isInternal && ! $isExternal) {
            $fail('Enter a valid link. Use https://example.com, /page-name, or #section.');
        }
    }
}
