<main class="px-2 space-y-4">
  <div class="p-6 text-2xl font-bold sm:p-6">
    Account Home
  </div>

  <div class="flex mt-2 text-md bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-1 sm:p-6">
    <div class="w-1/3">Data listed in Central Time</div>
    <div class="w-2/3 float-right">
      <a href="/settings/create-number" class="float-right mr-4 inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto">
        Create Number</a>
    </div>
  </div>

  <div class="grid grid-cols-1 gap-2 xl:grid-cols-4 2xl:grid-cols-4">

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 sm:p-6"><!--Total Calls-->

      <div class="flex items-center justify-between mb-4">
        <div class="flex-shrink-0">
          <span class="text-base leading-none text-gray-900 sm:text-md ">Total calls </span>
        </div>
        <div class="flex items-center justify-end flex-1 text-base font-medium text-green-500">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
          </svg>
          21.1%

          <h3 class="text-base font-light text-gray-500 ">| {{ $week}}</h3>
        </div>
      </div>
      <hr class="h-px my-8 bg-gray-200 border-0">

      <div class="flex justify-center pt-10">
        <span class="text-5xl font-semibold leading-none text-gray-800 sm:text-5xl">10</span>
      </div>

      <div class="flex justify-center">
        <span class="text-md font-bold leading-none text-gray-800 sm:text-md">First-time Callers</span>
      </div>

      <div class="flex justify-end pt-10">
        <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-800 rounded-lg hover:text-black hover:font-bold
          focus:text-black focus:font-bold">
          Review activity
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
          </svg>
        </a>
      </div>
    </div>

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 sm:p-6"><!-- First Time Callers -->
      <div class="flex items-center justify-between mb-4">
        <div class="flex-shrink-0">
          <span class="text-base leading-none text-gray-900 sm:text-md">Total First-time Callers </span>
        </div>
        <div class="flex items-center justify-end flex-1 text-base font-medium text-red-500">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 1v12m0 0 4-4m-4 4L1 9" />
          </svg>
          30.3%
          <!-- to be solve -->
          <h3 class="text-base font-light text-gray-500 ">| {{ $week }}</h3>
        </div>
      </div>
      <hr class="h-px my-8 bg-gray-200 border-0">

      <div class="flex justify-center pt-10">
        <span class="text-5xl font-semibold leading-none text-gray-800 sm:text-5xl">10</span>
      </div>

      <div class="flex justify-center">
        <span class="text-md font-bold leading-none text-gray-800 sm:text-md">First-time Callers</span>
      </div>
      <!-- Link -->
      <div class="flex justify-end pt-10">
        <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-800 rounded-lg hover:text-black hover:font-bold
          focus:text-black focus:font-bold">
          Review activity
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
          </svg>
        </a>
      </div>
    </div>

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-3 sm:p-6"><!-- Calls by number -->
      <div class="flex items-center justify-between mb-4">
        <div class="flex-shrink-0">
          <span class="text-base leading-none text-gray-900 sm:text-md">Calls by number</span>
        </div>
        <div class="flex items-center justify-end flex-1 text-base font-medium">
          <h3 class="text-base font-light text-gray-500 ">Last 7 days compared to previous period</h3>
        </div>
      </div>
      <hr class="h-px my-8 bg-gray-200 border-0">
      <div id="callbynumber"></div>
      <div class="flex justify-end pt-10">
        <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-800 rounded-lg hover:text-black hover:font-bold
          focus:text-black focus:font-bold">
          Open Report
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
          </svg>
        </a>
      </div>
    </div>

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-1 sm:p-6"><!-- Call attribution by source -->
      <div class="flex items-center justify-between mb-4">
        <div class="flex-shrink-0">
          <span class="text-base leading-none text-gray-900 sm:text-md">Call attribution by source</span>
        </div>

        <div class="flex items-center justify-end flex-1 text-base font-medium">
          <h3 class="text-base font-light text-gray-500 ">{{ $week }}</h3>
        </div>
      </div>
      <hr class="h-px my-8 bg-gray-200 border-0">
      <div id="callbyattribution"></div>
      <div class="flex justify-end pt-10">
        <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-800 rounded-lg hover:text-black hover:font-bold
          focus:text-black focus:font-bold">
          Open Report
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
          </svg>
        </a>
      </div>

    </div>

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 sm:p-6"><!-- Call Status -->
      <div class="flex items-center justify-between mb-4">
        <div class="flex-shrink-0">
          <span class="text-base leading-none text-gray-900 sm:text-md">Call Status</span>
        </div>

        <div class="flex items-center justify-end flex-1 text-base font-light text-gray-500 ">
          <button type="button">
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 1v5h-5M2 19v-5h5m10-4a8 8 0 0 1-14.947 3.97M1 10a8 8 0 0 1 14.947-3.97" />
            </svg>
          </button>
          Today
        </div>
      </div>
      <hr class="h-px my-8 bg-gray-200 border-0">

      <div class="flex flex-col w-full mt-5 space-y-2 text-gray-900 bg-white h-1/3">
        <div class="text-center">
          <button type="button" class="relative inline-flex w-full space-x-4 px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 
              focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
            <svg class="w-[16px] h-[16px] text-purple-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
              <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
            </svg>
            <span>Outbound . (__% of calls today)</span>
          </button>

        </div>
        <button type="button" class="relative text-center inline-flex space-x-4  w-full px-4 py-2 text-sm font-medium border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
          <svg class="w-[16px] h-[16px] text-green-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
            <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
          </svg>
          <span>Answered . (__% of calls today) </span>
        </button>
        <button type="button" class="relative text-center inline-flex space-x-4 w-full px-4 py-2 text-sm font-medium border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
          <svg class="w-[16px] h-[16px] text-red-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
            <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
          </svg>
          <span>Missed . (__% of calls today)</span>
        </button>
        <button type="button" class="relative text-center inline-flex space-x-4 w-full px-4 py-2 text-sm font-medium rounded-b-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
          <svg class="w-[16px] h-[16px] text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
            <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
          </svg>
          <span>Abandoned . (__% of calls today)</span>
        </button>
      </div>



    </div>

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 sm:p-6"><!-- Unanswered Calls by Hour -->
      <div class="flex items-center justify-between mb-4">
        <div class="flex-shrink-0">
          <span class="text-base leading-none text-gray-900 sm:text-md">Unanswered Calls by Hour</span>
        </div>
        <div class="flex items-center justify-end flex-1 text-base font-light text-gray-500 ">
          <button type="button">
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 1v5h-5M2 19v-5h5m10-4a8 8 0 0 1-14.947 3.97M1 10a8 8 0 0 1 14.947-3.97" />
            </svg>
          </button>
          Today
        </div>
      </div>
      <hr class="h-px my-8 bg-gray-200 border-0">
      <div id="unansweredcalls"></div>
      <div class="flex justify-end pt-10">
        <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-800 rounded-lg hover:text-black hover:font-bold
          focus:text-black focus:font-bold">
          Review activity
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
          </svg>
        </a>
      </div>
    </div>

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-4 sm:p-6"><!-- Recent activity -->
      <div class="flex items-center justify-between mb-4">
        <div class="flex-shrink-0">
          <span class="text-base leading-none text-gray-900 sm:text-md">Recent activity </span>
        </div>
        <div class="flex items-center justify-end flex-1 text-base font-medium">
          <button type="button">
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 1v5h-5M2 19v-5h5m10-4a8 8 0 0 1-14.947 3.97M1 10a8 8 0 0 1 14.947-3.97" />
            </svg>
          </button>

          <h3 class="text-base font-light text-gray-500 "> Today</h3>
        </div>
      </div>
      <hr class="h-px my-8 bg-gray-200 border-0">

      <div class="flex flex-col mt-6">
        <div class="overflow-x-auto rounded-lg">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200 ">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                      Call ID
                    </th>
                    <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                      Reference
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                  <tr>
                    <td class="p-4 text-sm font-normal font-xs text-gray-900 whitespace-nowrap">
                      Call to <span class="font-semibold">Houston Sex Store 3-16-22 (346) 358-6844</span>
                    </td>
                    <td class="p-4 text-sm font-normal font-xs text-gray-500 whitespace-nowrap ">
                      a98fb001-0213-4f42-87ff-1cafa52b510e
                    </td>

                  </tr>
                  <tr class="bg-gray-50">
                    <td class="p-4 text-sm font-normal font-xs text-gray-900 whitespace-nowrap">
                      Call From <span class="font-semibold">+14304402347</span>
                    </td>
                    <td class="p-4 text-sm font-normal font-xs text-gray-500 whitespace-nowrap ">
                      a98fb001-0213-4f42-87ff-1cafa52b510e
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-end pt-10">
        <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-800 rounded-lg hover:text-black hover:font-bold
          focus:text-black focus:font-bold">
          Review activity
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
          </svg>
        </a>
      </div>
    </div>




    @push('scripts')
    <script>
      var options = {
        series: [{
          name: 'Last 7 Days',
          data: [10, 20, 30]
        }, {
          name: 'Previous Period',
          data: [40, 30, 20]
        }],
        chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Google My Business', 'Child Support', 'Google Ads'],
        },
        yaxis: {
          title: {
            text: 'Number of Calls'
          }
        },
        fill: {
          opacity: 1
        }

      };

      var chart = new ApexCharts(document.querySelector("#callbynumber"), options);
      chart.render();

      var options2 = {
        series: [44, 55, 33],
        chart: {
          width: 400,
          height: 500,
          type: 'pie',
        },
        labels: ['Google My Business', 'Child Support', 'Google Ads'],
        responsive: [{
          breakpoint: 400,
          options: {
            chart: {
              width: 50
            },
            legend: {
              show: false,
              position: 'left'
            }
          }
        }]
      };

      var chart2 = new ApexCharts(document.querySelector("#callbyattribution"), options2);
      chart2.render();

      // Unanswered calls
      var options3 = {
        series: [{
          name: 'Unanswered Call(s)',
          data: [null, null, null, null, null, null, null, null, null, null, 1, 2,
            null, null, null, null, null, null, null, null, null, null, null, null
          ]
        }, {
          name: 'Answered Call(s)',
          data: [null, null, null, null, null, null, null, null, null, 3, 1, 2,
            null, null, null, null, null, null, null, null, null, null, null, null
          ]
        }],
        chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: 2
        },

        xaxis: {

          labels: {
            rotate: 45
          },
          categories: ['12 AM', '1 AM', '2 AM', '3 AM', '4 AM', '5 AM', '6 AM', '7 AM', '8 AM', '9 AM', '10 AM', '11 AM',
            '12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM', '6 PM', '7 PM', '8 PM', '9 PM', '10 PM', '11 PM'
          ],
          tickPlacement: 'on',
          formatter: function(val) {
            return val.toFixed(0);
          }
        }


      };

      var chart3 = new ApexCharts(document.querySelector("#unansweredcalls"), options3);
      chart3.render();
    </script>

    @endpush