@include('errors.minimal', [
    'statusCode' => 503,
    'title' => 'Website temporarily unavailable',
    'message' => 'The website is temporarily unavailable. Please try again shortly.',
])
