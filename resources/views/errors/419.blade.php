@include('errors.minimal', [
    'statusCode' => 419,
    'title' => 'Session expired',
    'message' => 'Your session has expired for security. Please refresh the page and submit the form again.',
])
