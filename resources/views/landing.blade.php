<?php
// Start session in case we need to track user type (optional)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Make a Difference Today</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: rgb(37, 99, 235);  /* Same blue as bg-blue-600 */
        }
    </style>
</head>
<body class="min-h-screen p-8 bg-blue-600">
    <!-- Header Section -->
    <div class="max-w-6xl mx-auto text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Make a Difference Today</h1>
        <p class="text-lg text-white opacity-90">Your generosity can transform lives. Choose how you want to contribute to our cause.</p>
    </div>

    <!-- Donation Cards -->
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <!-- Monetary Donation Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 transform transition hover:scale-105">
            <div class="text-blue-600 mb-4">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-blue-900 mb-2">Monetary Donation</h2>
            <p class="text-blue-600 mb-6">Support our cause with financial contributions</p>
            <a href="{{ route('monetary_donation') }}" class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                Donate Now
            </a>
        </div>

        <!-- Non-Monetary Donation Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 transform transition hover:scale-105">
            <div class="text-blue-600 mb-4">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-blue-900 mb-2">Non-Monetary Donation</h2>
            <p class="text-blue-600 mb-6">Donate goods, supplies, or materials</p>
            <a href="{{ route('non_monetary') }}" class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                Donate Now
            </a>
        </div>

        <!-- Campaigns Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 transform transition hover:scale-105">
            <div class="text-blue-600 mb-4">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-blue-900 mb-2">Campaigns</h2>
            <p class="text-blue-600 mb-6">Join our specific donation campaigns</p>
            <a href="{{ route('user.calendar') }}" class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                Join Campaign
            </a>
        </div>
    </div>
    
<!-- Urgent Donation Needs -->
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8 mb-16">
    <h2 class="text-2xl font-semibold text-blue-900 mb-6">Urgent Donation Needs</h2>
    <?php
        // Example: Fetch the current donation amount dynamically from the monetary_donations table
        $donationGoal = 50000.00; // Target amount
        $currentDonation = DB::table('monetary_donations')->sum('amount'); // Use monetary_donations table

        // Calculate the percentage of the goal achieved
        $progressPercentage = ($currentDonation / $donationGoal) * 100;
    ?>
    <div class="mb-8">
        <div class="flex justify-between text-sm text-blue-600 mb-2">
            <span class="font-semibold">Help Those Affected by Typhoon X</span>
            <span><?php echo number_format($progressPercentage, 2); ?>% of the goal achieved (Goal: ₱<?php echo number_format($donationGoal, 2); ?>)</span>
        </div>
        <div class="h-4 bg-blue-100 rounded-full overflow-hidden">
            <div class="h-full bg-blue-600 rounded-full" style="width: <?php echo $progressPercentage; ?>%;"></div>
        </div>
        <p class="text-sm text-blue-600 mt-2">Urgent support needed for food, shelter, and medical supplies.</p>
        <a href="{{ route('monetary_donation') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg mt-4 hover:bg-blue-700 transition-colors font-medium">
            Donate Now
        </a>
    </div>
</div>

    <!-- Top Donors -->
    <div class="max-w-4xl mx-auto mb-16">
        <h2 class="text-2xl font-semibold text-white mb-6 text-center">Our Top Donors</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <span class="text-blue-600 font-semibold">JA</span>
                </div>
                <span class="text-blue-900 font-medium">John Anderson</span>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <span class="text-blue-600 font-semibold">SW</span>
                </div>
                <span class="text-blue-900 font-medium">Sarah Williams</span>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <span class="text-blue-900 font-medium">Anonymous Donor</span>
            </div>
        </div>
    </div>
<!-- Stories of Impact -->
<div class="max-w-6xl mx-auto mb-16">
    <h2 class="text-2xl font-semibold text-white-900 mb-6 text-center">Stories of Impact</h2>
    <!-- Flex container for stories -->
    <div class="flex flex-col md:flex-row gap-8">
        <!-- First Story -->
        <div class="bg-white rounded-2xl shadow-lg p-8 flex-1">
    <div class="h-64 overflow-hidden rounded-xl mb-4">
        <img src="{{ asset('storage/Impact/Gwyne_Otida_Student.jpg') }}" alt="Current Student" 
             class="w-full h-full object-contain">
    </div>
    <div class="flex-1 flex flex-col">
        <h3 class="text-xl font-semibold text-blue-900 mb-2">Gwyne Otida</h3>
        <p class="text-blue-600">"As a child who grew up in a less privileged household, I am deprived into a lot of things that make me wonder if I really have a purpose or did, I just accidentally exist.
Looking back, no matter how hard I try to go out of my used zone and explore my potential, the ropes and shadows of poverty would always follow me- cagging, gripping, and locking me into the box of where I came from. At that time, life never allowed me to dream and fly beyond using my abilities.
    However, between those dark days a literal light comes my way- Hauz Hayag Scholarship and Training Program. They pulled me up into the abyss of hopelessness. Day by day I can see myself improving and rebuilding my shattered dreams. Being in Hauz Hayag allows me to regenerate and thrive once more. They made me realize that I am bigger than my problems and painful situation and because of Hauz Hayag I dream again, I believe again, and I trust myself again. Me and my family are so grateful to meet kind souls. 
    That younger version of me must really be proud to the person I am becoming and thankful for making it this far."</p>
    </div>
</div>

<!-- Second Story -->
<div class="bg-white rounded-2xl shadow-lg p-8 flex-1">
    <div class="h-64 overflow-hidden rounded-xl mb-4">
        <img src="{{ asset('storage/Impact/Daylyn_Unabia_Alumni.jpg') }}" alt="Alumni" 
             class="w-full h-full object-contain">
    </div>
    <div class="flex-1 flex flex-col">
        <h3 class="text-xl font-semibold text-blue-900 mb-2">Daylyn Unabia</h3>
        <p class="text-blue-600">"Living in a low-income family with eight siblings was really challenging. Access to basic needs such as food, clothing, and medical care was limited due to financial difficulties. Sharing few resources and making sacrifices for the family's welfare were part of daily life. There were few chances for personal development and a lack of assurance about the future. Being accepted in Hauz Hayag Scholarship and Training Program Inc. was a huge relief and a gateway to new opportunities.
Life after graduation and now working:
I am very grateful of the opportunity to give significant contributions to my family's well-being after I finished my undergraduate years in Biology at USC, while at the same time pursuing graduate studies. I am currently working as a researcher, and trying to have a positive influence in the community while juggling research and personal life. My goal as a researcher is to advance biological knowledge for the good of society, in general. I'm motivated to help and make my family and the people that I love proud despite obstacles. Through hard work and dedication, I aim to create a brighter future for myself and those I care about."</p>
    </div>
</div>
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
    </div>
  </body>
</html>
