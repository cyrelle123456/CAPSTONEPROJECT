<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Monetary Donation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: rgb(37, 99, 235); /* Same blue as bg-blue-600 */
        }
    </style>
</head>
<body class="min-h-screen bg-blue-600 flex flex-col">
    
    <div class="flex-grow flex items-center justify-center p-6">
        <div class="bg-white rounded-2xl shadow-lg w-full max-w-4xl p-8 relative">
            <!-- Close Button -->
            <button onclick="window.location.href='/'" class="absolute right-6 top-6 text-blue-300 hover:text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <h2 class="text-2xl md:text-3xl font-bold text-blue-900 text-center mb-2">Monetary Donation</h2>
            <p class="text-lg text-blue-600 text-center mb-8">Your generosity makes a difference</p>
            
            <form id="donationForm" action="{{ route('monetary_donation.submit') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @csrf

                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-blue-900 mb-2">Donation Method</label>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input id="bank-transfer" name="payment_method" type="radio" value="bank_transfer" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-blue-300">
                                <label for="bank-transfer" class="ml-3 block text-sm font-medium text-blue-900">Bank Transfer</label>
                            </div>
                            <div class="flex items-center">
                                <input id="gcash" name="payment_method" type="radio" value="gcash" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-blue-300">
                                <label for="gcash" class="ml-3 block text-sm font-medium text-blue-900">GCash</label>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Transfer Details (shown by default) -->
                    <div id="bankDetails" class="space-y-4 bg-blue-50 p-4 rounded-lg">
                        <h3 class="text-sm font-semibold text-blue-900">Bank Transfer Details</h3>
                        <div class="text-sm text-blue-600">
                            <p><strong>Bank Name:</strong> Example Bank</p>
                            <p><strong>Account Name:</strong> Hauz Hayag Organization</p>
                            <p><strong>Account Number:</strong> 1234-5678-9012</p>
                            <p><strong>Branch:</strong> Main Branch</p>
                        </div>
                    </div>

                    <!-- GCash Details (hidden by default) -->
                    <div id="gcashDetails" class="space-y-4 bg-blue-50 p-4 rounded-lg hidden">
                        <h3 class="text-sm font-semibold text-blue-900">GCash Details</h3>
                        <div class="text-sm text-blue-600">
                            <p><strong>GCash Number:</strong> 0917 123 4567</p>
                            <p><strong>Account Name:</strong> Charity Organization</p>
                            <p class="mt-2">Please use your name as the reference when sending.</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-blue-900 mb-2">Amount (PHP)</label>
                        <input type="number" name="amount" placeholder="Enter amount" min="1" required class="w-full px-4 py-2.5 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-blue-900 mb-2">Name</label>
                        <input type="text" name="donor_name" placeholder="Full Name" required class="w-full px-4 py-2.5 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-blue-900 mb-2">Email</label>
                        <input type="email" name="donor_email" placeholder="you@email.com" required class="w-full px-4 py-2.5 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-blue-900 mb-2">Contact Number</label>
                        <input type="tel" name="donor_phone" placeholder="Your contact number" required class="w-full px-4 py-2.5 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-blue-900 mb-2">Upload Proof of Payment</label>
                        <div class="border-2 border-dashed border-blue-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition-colors" onclick="document.getElementById('proofUpload').click()">
                            <div id="proofUploadText" class="space-y-2">
                                <svg class="mx-auto h-12 w-12 text-blue-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="text-blue-600 font-medium">browse files</div>
                                <div class="text-xs text-blue-500">(Screenshot or photo of transaction receipt)</div>
                            </div>
                            <input type="file" id="proofUpload" name="proof" accept="image/*,.pdf" class="hidden" onchange="previewProof(event)">
                            <div id="proofPreview" class="hidden mt-4">
                                <p class="text-sm font-medium text-blue-900">Selected file:</p>
                                <p id="proofFilename" class="text-sm text-blue-600"></p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-blue-900 mb-2">Message (Optional)</label>
                        <textarea name="message" rows="3" placeholder="Any additional message..." class="w-full px-4 py-2.5 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>
                </div>

                <!-- Important Information -->
                <div class="md:col-span-2 bg-blue-50 p-4 rounded-lg border-l-4 border-blue-600">
                    <div class="flex items-start">
                        <svg class="h-6 w-6 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-blue-900">Important Information</p>
                            <p class="mt-1 text-sm text-blue-600">
                                Your donation will be processed within 24 hours. Please ensure your proof of payment is clear and shows the transaction details. 
                                You will receive a confirmation email once your donation is verified. For any questions, please contact <span class="underline text-blue-700">donations@charity.org</span>.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="md:col-span-2 flex justify-end space-x-4 mt-6">
                    <button type="button" onclick="window.location.href='{{ route('entry') }}'" class="px-6 py-2.5 bg-white text-blue-700 border border-blue-600 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition-colors font-medium">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">Submit Donation</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-12">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-semibold mb-4">Hauz Hayag</h3>
                <p class="text-blue-100">Making a difference in communities through collective giving.</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-4">Contact</h3>
                <p class="text-blue-100">contact@hauzhayag.org</p>
                <p class="text-blue-100">+1 (555) 123-4567</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-4">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-blue-100 hover:text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="text-blue-100 hover:text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" class="text-blue-100 hover:text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.419.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="max-w-6xl mx-auto px-4 mt-8 pt-8 border-t border-blue-800">
            <p class="text-center text-blue-100">&copy; {{ date('Y') }} Hauz Hayag. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Toggle between bank and GCash details
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'bank_transfer') {
                    document.getElementById('bankDetails').classList.remove('hidden');
                    document.getElementById('gcashDetails').classList.add('hidden');
                } else {
                    document.getElementById('bankDetails').classList.add('hidden');
                    document.getElementById('gcashDetails').classList.remove('hidden');
                }
            });
        });

        function previewProof(event) {
            const input = event.target;
            const proofPreview = document.getElementById('proofPreview');
            const proofUploadText = document.getElementById('proofUploadText');
            const proofFilename = document.getElementById('proofFilename');
            
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB
                
                if (file.size > maxSize) {
                    alert('File size must be less than 2MB');
                    input.value = '';
                    return;
                }
                
                proofFilename.textContent = file.name;
                proofPreview.classList.remove('hidden');
                proofUploadText.classList.add('hidden');
            }
        }

        // Form submission
        document.getElementById('donationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = 'Processing...';
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/entry';
                } else {
                    submitButton.disabled = false;
                    submitButton.innerHTML = 'Submit Donation';
                    if (data.errors) {
                        const errorMessages = Object.values(data.errors).flat().join('\n');
                        alert(errorMessages);
                    } else {
                        alert(data.message || 'An error occurred while processing your donation. Please try again.');
                    }
                }
            })
            .catch(error => {
                submitButton.disabled = false;
                submitButton.innerHTML = 'Submit Donation';
                console.error('Error:', error);
                alert('An error occurred while processing your donation. Please try again.');
            });
        });
    </script>
</body>
</html>