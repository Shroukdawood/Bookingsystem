<nav class="relative bg-gradient-to-r from-white-100 to-gray-400 shadow-md">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">

      <!-- Mobile menu button -->
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <button id="mobile-menu-button" type="button"
          class="relative inline-flex items-center justify-center rounded-md p-2 text-black hover:bg-gray-200 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 transition">
          <span class="sr-only">Open main menu</span>
          <!-- Icon when menu is closed -->
          <svg id="icon-open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <!-- Icon when menu is open -->
          <svg id="icon-close" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Logo & Links -->
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex shrink-0 items-center">
          <!-- logo optional -->
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            @auth
                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin.users') }}"
              class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white shadow hover:scale-105 transition duration-200">
              Users</a>
                @else
                 <a href="{{ route('booking.index') }}"
              class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white shadow hover:scale-105 transition duration-200">
              Booking System</a>
                @endif
            @endauth
            <!-- <a href="{{ route('booking.index') }}"
              class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white shadow hover:scale-105 transition duration-200">Booking System</a> -->

            @auth
              @if (auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}"
                  class="rounded-md px-3 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200 hover:text-gray-900 transition duration-200">Booking</a>
              @endif

              <a href="{{ route('profile.index', auth()->user()->id) }}"
                class="rounded-md px-3 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200 hover:text-gray-900 transition duration-200">Profile</a>
            @endauth
          </div>
        </div>
      </div>

      <!-- Right section -->
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        @if (Route::has('login'))
        <nav class="flex items-center gap-4">
          @auth
          <!-- Logout button -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
              class="px-4 py-1.5 bg-red-500 text-white rounded hover:bg-red-600 transition shadow">
              Logout
            </button>
          </form>
          @else
          <a href="{{ route('login') }}"
            class="px-4 py-1.5 bg-gradient-to-r from-gray-400 to-blue-500 text-white rounded hover:from-gray-500 hover:to-blue-600 transition shadow">
            Log in
          </a>
          @if (Route::has('register'))
          <a href="{{ route('register') }}"
            class="px-4 py-1.5 bg-gradient-to-r from-gray-400 to-green-500 text-white rounded hover:from-gray-500 hover:to-green-600 transition shadow">
            Register
          </a>
          @endif
          @endauth
        </nav>
        @endif
      </div>
    </div>
  </div>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="sm:hidden hidden">
    <div class="space-y-1 px-2 pt-2 pb-3">
      <a href="{{ route('booking.index') }}"
        class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white shadow">Booking System</a>

      @auth
        @if (auth()->user()->is_admin)
        <a href="{{ route('admin.dashboard') }}"
          class="block rounded-md px-3 py-2 text-base font-medium text-gray-800 hover:bg-gray-200 hover:text-gray-900 transition">Admin Dashboard</a>
        <a href="{{ route('admin.users') }}"
          class="block rounded-md px-3 py-2 text-base font-medium text-gray-800 hover:bg-gray-200 hover:text-gray-900 transition">Users</a>
        @endif
      @endauth

      @auth
      <a href="{{ route('profile.index', auth()->user()->id) }}"
        class="block rounded-md px-3 py-2 text-base font-medium text-gray-800 hover:bg-gray-200 hover:text-gray-900 transition">Profile</a>
      @endauth
    </div>
  </div>
</nav>

<script>
  // Toggle mobile menu
  const menuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const iconOpen = document.getElementById('icon-open');
  const iconClose = document.getElementById('icon-close');

  menuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
    iconOpen.classList.toggle('hidden');
    iconClose.classList.toggle('hidden');
  });
</script>
