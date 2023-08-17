
<nav class="w-screen bg-red-500 h-14 shadow-lg">
    <div class="grid grid-cols-2 h-full">
        <div class="h-full">
            <div class="flex items-center h-full">
               <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mx-3 text-sm text-red-500 rounded-lg bg-white hover:scale-105 shadow-xl"> 
                   <span class="sr-only">Open sidebar</span>
                   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                   </svg>
                </button>
                <h1 id="pageTitle" class="whitespace-nowrap mt-1 uppercase font-bold text-xl tracking-wider text-white">@yield('title')</h1>
            </div>
        </div>

        {{-- <div class="h-full justify-self-center">
            @if (!Str::contains(url()->current(), url('/schedule-board')))
               <div class="hidden sm:flex items-center h-full text-white text-xl font-bold">
                  {{ date('F j, Y') }}
               </div>
            @endif
        </div> --}}

        <form method="get" action="{{ route('logout') }}" class="w-36 h-full p-2.5 justify-self-end">
            @csrf
            <button type="submit" class="bg-white text-red-500 w-full h-full rounded-xl hover:scale-105 shadow-lg font-black tracking-wider flex justify-center items-center">
                <span>LOGOUT</span>
            </button>
        </form>
    </div>
</nav>


<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-72 h-screen transition-transform -translate-x-full" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="{{ route('dashboard.index') }}" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-300 hover:text-gray-700 border-gray-300 {{ (Str::contains(url()->current(), url('/dashboard'))) ? 'scale-105 bg-gray-300 border border-gray-300 shadow' : '' }}">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 -960 960 960"><path xmlns="http://www.w3.org/2000/svg" d="M510-570v-270h330v270H510ZM120-450v-390h330v390H120Zm390 330v-390h330v390H510Zm-390 0v-270h330v270H120Zm60-390h210v-270H180v270Zm390 330h210v-270H570v270Zm0-450h210v-150H570v150ZM180-180h210v-150H180v150Zm210-330Zm180-120Zm0 180ZM390-330Z"/></svg>
               <span class="ml-3">Dashboard</span>
            </a>
         </li>
         <li>
            <a href="{{ route('form.index') }}" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-300 hover:text-gray-700 border-gray-300 {{ (Str::contains(url()->current(), url('/schedule-board'))) ? 'scale-105 bg-gray-300 border border-gray-300 shadow' : '' }}">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 -960 960 960"><path xmlns="http://www.w3.org/2000/svg" d="M620-159 460-319l43-43 117 117 239-239 43 43-282 282Zm220-414h-60v-207h-60v90H240v-90h-60v600h251v60H180q-26 0-43-17t-17-43v-600q0-26 17-43t43-17h202q7-35 34.5-57.5T480-920q36 0 63.5 22.5T578-840h202q26 0 43 17t17 43v207ZM480-780q17 0 28.5-11.5T520-820q0-17-11.5-28.5T480-860q-17 0-28.5 11.5T440-820q0 17 11.5 28.5T480-780Z"/></svg>
               <span class="ml-3">Evaluation Forms</span>
            </a>
         </li>
         {{-- <li>
            <button type="button" class="flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg group hover:bg-gray-300 hover:text-gray-700 {{ (Str::contains(url()->current(), url('/logs'))) ? 'scale-105 bg-gray-300 border border-gray-300 shadow' : '' }}" aria-controls="system-logs" data-collapse-toggle="system-logs">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor"><path xmlns="http://www.w3.org/2000/svg" d="m800-134 28-28-75-75v-112h-40v128l87 87Zm-620 14q-24.75 0-42.375-17.625T120-180v-600q0-24.75 17.625-42.375T180-840h600q24.75 0 42.375 17.625T840-780v329q-14-8-29.5-13t-30.5-8v-308H180v600h309q4 16 9.023 31.172Q503.045-133.655 510-120H180Zm0-107v47-600 308-4 249Zm100-53h211q4-16 9-31t13-29H280v60Zm0-170h344q14-7 27-11.5t29-8.5v-40H280v60Zm0-170h400v-60H280v60ZM732.5-41Q655-41 600-96.5T545-228q0-78.435 54.99-133.717Q654.98-417 733-417q77 0 132.5 55.283Q921-306.435 921-228q0 76-55.5 131.5T732.5-41Z"/></svg>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Logs</span>
                  <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            <ul id="system-logs" class="hidden py-2 space-y-2">
               <li>
                  <a href="" class="flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 hover:text-gray-700 {{ (Str::contains(url()->current(), url('/logs/users'))) ? 'bg-gray-300 border border-gray-300 shadow' : '' }}">Customers</a>
               </li>
               <li>
                  <a href="" class="flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 hover:text-gray-700 {{ (Str::contains(url()->current(), url('/logs/users'))) ? 'bg-gray-300 border border-gray-300 shadow' : '' }}">Trainings</a>
               </li>
            </ul>
         </li> --}}

         @if (Auth::user()->role == 0)
            <li>
               <button type="button" class="flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg group hover:bg-gray-300 hover:text-gray-700 {{ (Str::contains(url()->current(), url('/system-management/users'))) ? 'scale-105 bg-gray-300 border border-gray-300 shadow' : '' }}" aria-controls="system-management" data-collapse-toggle="system-management">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor">
                     <path xmlns="http://www.w3.org/2000/svg" d="m388-80-20-126q-19-7-40-19t-37-25l-118 54-93-164 108-79q-2-9-2.5-20.5T185-480q0-9 .5-20.5T188-521L80-600l93-164 118 54q16-13 37-25t40-18l20-127h184l20 126q19 7 40.5 18.5T669-710l118-54 93 164-108 77q2 10 2.5 21.5t.5 21.5q0 10-.5 21t-2.5 21l108 78-93 164-118-54q-16 13-36.5 25.5T592-206L572-80H388Zm92-270q54 0 92-38t38-92q0-54-38-92t-92-38q-54 0-92 38t-38 92q0 54 38 92t92 38Zm0-60q-29 0-49.5-20.5T410-480q0-29 20.5-49.5T480-550q29 0 49.5 20.5T550-480q0 29-20.5 49.5T480-410Zm0-70Zm-44 340h88l14-112q33-8 62.5-25t53.5-41l106 46 40-72-94-69q4-17 6.5-33.5T715-480q0-17-2-33.5t-7-33.5l94-69-40-72-106 46q-23-26-52-43.5T538-708l-14-112h-88l-14 112q-34 7-63.5 24T306-642l-106-46-40 72 94 69q-4 17-6.5 33.5T245-480q0 17 2.5 33.5T254-413l-94 69 40 72 106-46q24 24 53.5 41t62.5 25l14 112Z"/>
                  </svg>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>System Management</span>
                  <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
               </button>
               <ul id="system-management" class="hidden py-2 space-y-2">
                     <li>
                        <a href="{{ route('users.index') }}" class="flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 hover:text-gray-700 {{ (Str::contains(url()->current(), url('/system-management/users'))) ? 'bg-gray-300 border border-gray-300 shadow' : '' }}">Users</a>
                     </li>
                     {{-- <li>
                        <a href="" class="flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 hover:text-gray-700 {{ (Str::contains(url()->current(), url('/system-management/departments'))) ? 'bg-gray-300 border border-gray-300 shadow' : '' }}">Departments</a>
                     </li> --}}
               </ul>
            </li>
         @endif
      </ul>
   </div>
</aside>