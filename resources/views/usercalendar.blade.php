<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calendar of Activities 2025</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      .calendar-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
      }
      .month-calendar {
        background: white;
        border-radius: 8px;
        padding: 16px;
      }
      .days-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 2px;
      }
      .day-cell {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        border: 1px solid #eee;
      }
      .day-header {
        font-weight: 500;
        color: #666;
        padding: 8px 0;
        text-align: center;
        font-size: 12px;
      }
      .campaign-card {
        transition: transform 0.2s;
      }
      .campaign-card:hover {
        transform: translateY(-4px);
      }
      .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 50;
      }
      .modal-content {
        position: relative;
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 500px;
      }
    </style>
  </head>
  <body class="bg-blue-600 min-h-screen">
    <!-- Modal -->
    <div id="campaignModal" class="modal">
      <div class="modal-content">
        <span class="absolute top-4 right-4 cursor-pointer" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle" class="text-xl font-bold mb-4"></h2>
        <p id="modalDescription" class="text-gray-600 mb-4"></p>
        <div class="flex justify-between items-center mb-4">
          <div>
            <span class="text-gray-500 text-sm">Target Amount</span>
            <p id="modalTarget" class="text-lg font-semibold"></p>
          </div>
          <div>
            <span class="text-gray-500 text-sm">Status</span>
            <p id="modalStatus" class="text-sm font-medium"></p>
          </div>
        </div>
        <div class="flex justify-between gap-4">
          <button onclick="closeModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">Close</button>
          <button onclick="editEvent()" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">Edit Event</button>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
      <div class="modal-content">
        <span class="absolute top-4 right-4 cursor-pointer" onclick="closeEditModal()">&times;</span>
        <h2 class="text-xl font-bold mb-4">Edit Event</h2>
        <form id="editEventForm" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Event Title</label>
            <input type="text" id="editTitle" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Event Type</label>
            <select id="editType" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
              <option value="registration">Registration</option>
              <option value="distribution">Distribution</option>
              <option value="feeding">Feeding</option>
              <option value="outreach">Outreach</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" id="editDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>
          <div class="flex justify-end gap-4">
            <button type="button" onclick="cancelEvent()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">Cancel Event</button>
            <button type="button" onclick="closeEditModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">Close</button>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">Save Changes</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="modal">
      <div class="modal-content">
        <span class="absolute top-4 right-4 cursor-pointer" onclick="closeConfirmModal()">&times;</span>
        <h2 class="text-xl font-bold mb-4">Confirm Cancellation</h2>
        <p class="text-gray-600 mb-6">Are you sure you want to cancel this event? This action cannot be undone.</p>
        <div class="flex justify-end gap-4">
          <button onclick="closeConfirmModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">No, Keep Event</button>
          <button onclick="confirmCancelEvent()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">Yes, Cancel Event</button>
        </div>
      </div>
    </div>

    <div class="container mx-auto px-4 py-8">
      <!-- Campaign Cards Section -->
      <div class="mb-12">
        <h2 class="text-2xl font-bold text-center text-white-900 mb-8">Choose a Campaign to Support</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Feeding Program Card -->
          <!-- Feeding Program Card -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-transform duration-200 hover:-translate-y-1">
    <div class="relative h-56">
        <img src="{{ asset('images/campaigns/feeding-program.jpg') }}"
             alt="Children receiving meals"
             class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500"
             onerror="this.onerror=null; this.src='{{ asset('images/default.jpg') }}'">
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
        <div class="absolute top-4 left-4">
            <span class="bg-green-500 text-white px-4 py-1.5 rounded-full text-sm font-medium shadow-md">
                Feeding Program
            </span>
        </div>
        <div class="absolute top-4 right-4">
            <span class="bg-green-500 text-white px-4 py-1.5 rounded-full text-sm font-medium shadow-md">
                Ongoing
            </span>
        </div>
    </div>
    <div class="p-6">
        <p class="text-gray-600 text-sm mb-4">Help provide meals for children in need. Every Sunday we serve nutritious meals to families.</p>
        <div class="flex justify-between items-center">
            <div>
                <span class="text-gray-500 text-sm">Target</span>
                <p class="text-green-600 font-semibold">₱500,000</p>
            </div>
            <button onclick="window.location.href='{{ route('user.campaign') }}'" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors text-sm font-medium shadow-sm hover:shadow-md">
                Join Campaign
            </button>
        </div>
    </div>
</div>
          <!-- Outreach Program Card -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-transform duration-200 hover:-translate-y-1">
    <div class="relative h-56">
        <img src="{{ url('images/campaigns/outreach-program.jpg') }}"
             alt="Community outreach activities"
             class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500"
             onerror="this.onerror=null; this.src='{{ url('images/default.jpg') }}'">
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
        <div class="absolute top-4 left-4">
            <span class="bg-blue-500 text-white px-4 py-1.5 rounded-full text-sm font-medium shadow-md">
                Outreach Program
            </span>
        </div>
        <div class="absolute top-4 right-4">
            <span class="bg-blue-500 text-white px-4 py-1.5 rounded-full text-sm font-medium shadow-md">
                Ongoing
            </span>
        </div>
    </div>
    <div class="p-6">
        <p class="text-gray-600 text-sm mb-4">Support community programs including medical missions at a barangay or barangays.</p>
        <div class="flex justify-between items-center">
            <div>
                <span class="text-gray-500 text-sm">Target</span>
                <p class="text-blue-600 font-semibold">₱300,000</p>
            </div>
            <button onclick="window.location.href='{{ route('user.campaign') }}'" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors text-sm font-medium shadow-sm hover:shadow-md">
                Join Campaign
            </button>
        </div>
    </div>
</div>
          <!-- Rice Distribution Card -->
          <div class="campaign-card bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg">
    <div class="relative h-56">
        <img src="{{ asset('images/campaigns/rice-distribution.jpg') }}"
             alt="Rice distribution to community"
             class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500"
             onerror="this.onerror=null; this.src='{{ asset('images/default.jpg') }}'">
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
        <div class="absolute top-4 left-4">
            <span class="bg-yellow-500 text-white px-4 py-1.5 rounded-full text-sm font-medium shadow-md">
                Rice Distribution
            </span>
        </div>
        <div class="absolute top-4 right-4">
            <span class="bg-yellow-500 text-white px-4 py-1.5 rounded-full text-sm font-medium shadow-md">
                Ongoing
            </span>
        </div>
    </div>
    <div class="p-6">
        <p class="text-gray-600 text-sm mb-4">Help distribute rice sacks to struggling families monthly.</p>
        <div class="flex justify-between items-center">
            <div>
                <span class="text-gray-500 text-sm">Target</span>
                <p class="text-yellow-600 font-semibold">₱200,000</p>
            </div>
            <button onclick="window.location.href='{{ route('user.campaign') }}'" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg transition-colors text-sm font-medium shadow-sm hover:shadow-md mt-6">
                Join Campaign
            </button>
        </div>
    </div>
</div>
          </div>
        </div>
      </div>
      <!-- Calendar Section -->
      <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">CALENDAR OF ACTIVITIES 2025</h2>

        <!-- Calendar Grid -->
        <div class="calendar-grid">
          @php
            $months = [
              'JANUARY', 'FEBRUARY', 'MARCH', 'APRIL',
              'MAY', 'JUNE', 'JULY', 'AUGUST',
              'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'
            ];
            $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
          @endphp

          @foreach($months as $index => $month)
            <div class="month-calendar">
              <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $month }}</h3>
              <div class="days-grid mb-2">
                @foreach($days as $day)
                  <div class="day-header">{{ $day }}</div>
                @endforeach
              </div>
              <div class="days-grid">
                @php
                  $firstDay = new DateTime("2025-" . ($index + 1) . "-01");
                  $daysInMonth = (int)$firstDay->format('t');
                  $firstDayOfWeek = (int)$firstDay->format('w');

                  // Define events for each month
                  $events = [
                    '1' => [], // January
                    '2' => [], // February
                    '3' => [], // March
                    '4' => [], // April
                    '5' => [], // May
                    '6' => [], // June
                    '7' => [], // July
                    '8' => [], // August
                    '9' => [], // September
                    '10' => [], // October
                    '11' => [], // November
                    '12' => []  // December
                  ];

                  // Add empty cells for days before the first day of the month
                  for($i = 0; $i < $firstDayOfWeek; $i++) {
                    echo '<div class="day-cell text-gray-300"></div>';
                  }

                  // Add cells for each day of the month
                  for($day = 1; $day <= $daysInMonth; $day++) {
                    $isToday = false; // You can add logic to highlight today
                    $event = $events[$index + 1][$day] ?? null;

                    $classes = 'day-cell relative group cursor-pointer ' . ($isToday ? 'bg-green-50 font-bold' : '');
                    if ($event) {
                      $classes .= ' bg-' . ($event['type'] === 'registration' ? 'blue' :
                                        ($event['type'] === 'distribution' ? 'yellow' :
                                        ($event['type'] === 'feeding' ? 'green' : 'purple'))) . '-50';
                    }

                    $date = sprintf("2025-%02d-%02d", $index + 1, $day);
                    echo "<div class='$classes' onclick='showEventDetails(\"$date\")' data-date='$date'>";
                    echo $day;
                    if ($event) {
                      echo "<div class='absolute bottom-0 left-0 right-0 bg-" .
                           ($event['type'] === 'registration' ? 'blue' :
                            ($event['type'] === 'distribution' ? 'yellow' :
                             ($event['type'] === 'feeding' ? 'green' : 'purple'))) .
                           "-500 text-white text-xs p-1 truncate hidden group-hover:block'>" .
                           $event['title'] . "</div>";
                    }
                    echo "</div>";
                  }

                  // Add empty cells for remaining days
                  $remainingCells = (7 - (($firstDayOfWeek + $daysInMonth) % 7)) % 7;
                  for($i = 0; $i < $remainingCells; $i++) {
                    echo '<div class="day-cell text-gray-300"></div>';
                  }
                @endphp
              </div>
            </div>
          @endforeach
        </div>

        <!-- Event Overlay -->
        <div class="mt-8">
          <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">Open Jan 22 - Feb 28, 2025</h3>
                <p class="text-sm text-green-700 mt-1">Registration for outreach program volunteers</p>
              </div>
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
