@include('errors.minimal', [
    'statusCode' => 429,
    'title' => 'Too many requests',
    'message' => 'Please wait a moment before trying again.',
])
