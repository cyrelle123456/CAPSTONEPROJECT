<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-600 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md text-center">
        <div class="mb-6">
            <svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Thank You!</h2>
        <p class="text-gray-600 mb-6">Your donation has been successfully submitted. We appreciate your generosity and support.</p>
        
        <a href="{{ route('landing') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
            Return to Home
        </a>
    </div>
</body>
</html>