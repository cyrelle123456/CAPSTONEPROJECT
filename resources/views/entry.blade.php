<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Entry</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-600 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">How would you like to proceed?</h2>
        
        <div class="space-y-4">
            <a href="{{ route('thank-you') }}" class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                Donate Anonymously
            </a>
            
            <a href="{{ route('thank-you') }}" class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                Be Acknowledged
            </a>
        </div>
    </div>
</body>
</html>