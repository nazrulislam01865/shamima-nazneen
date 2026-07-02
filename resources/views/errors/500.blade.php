@include('errors.minimal', [
    'statusCode' => 500,
    'title' => 'Something went wrong',
    'message' => 'The request could not be completed right now. Please try again in a moment.',
])
