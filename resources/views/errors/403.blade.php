@include('errors.minimal', [
    'statusCode' => 403,
    'title' => 'Access is not allowed',
    'message' => 'You do not have permission to open this page. Please sign in with an authorized account or contact the site administrator.',
])
