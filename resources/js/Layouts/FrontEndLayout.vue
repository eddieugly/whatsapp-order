<template>
  <div class="antialiased">
    <!-- NavBar -->
    <header>
      <nav class="bg-transparent border-gray-200 px-4 lg:px-6 py-4 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
          <Link href="/" class="flex items-center">
            <Logo class="" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ $page.props.general.company_name }}</span>
          </Link>
          <div class="flex items-center lg:order-2">
            <!-- phone number -->
            <div class="ml-auto mx-2 py-2 md:w-48 hidden sm:flex flex-col place-items-end">
              <span class="font-bold md:text-xl">8 800 332 65-66</span>
              <span class="font-semibold text-sm text-gray-400">Support 24/7</span>
            </div>
            <Link :href="route('login')"
              class="hover:bg-orange-200 focus:ring-4 focus:ring-gray-300 text-gray-800 dark:text-white hover:text-yellow-700 font-medium rounded-lg px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
              <UserIcon class="w-6 h-6" />
            </Link>
            <Link :href="route('frontend.cart.index')"
              class="relative inline-flex hover:bg-orange-200 focus:ring-4 focus:ring-gray-300 text-gray-800 dark:text-white hover:text-yellow-700 font-medium rounded-lg px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
              <CartIcon class="w-6 h-6" />
              <div
                class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-yellow-600 border-2 border-white rounded-full -top-2 right-2 dark:border-gray-900">
                {{ cartStore.cart.length }}
              </div>
            </Link>
            <button data-drawer-target="default-sidebar-0909" data-drawer-toggle="default-sidebar-0909"
              aria-controls="default-sidebar-0909" aria-expanded="false" type="button"
              class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
              <span class="sr-only">Open sidebar</span>
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
              </svg>
            </button>
          </div>
          <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 font-semibold lg:flex-row lg:space-x-8 lg:mt-0">
              <li>
                <NavLink :href="route('home')" :active="route().current('home')">
                  Home
                </NavLink>
              </li>
              <li>
                <NavLink :href="route('frontend.categories')" :active="route().current('frontend.categories') || route().current('frontend.category.index')">
                  Categories
                </NavLink>
              </li>
              <li>
                <NavLink :href="route('frontend.menus')" :active="route().current('frontend.menus') || route().current('frontend.menu.index')">
                  Menus
                </NavLink>
              </li>
              <li>
                <NavLink :href="route('frontend.faq')" :active="route().current('frontend.faq')">
                  FAQ
                </NavLink>
              </li>
              <li>
                <NavLink :href="route('frontend.contact.index')" :active="route().current('frontend.contact.index')">
                  Contact
                </NavLink>
              </li>
            </ul>
          </div>
        </div>
        <aside id="default-sidebar-0909" class="lg:hidden fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full lg:translate-x-0"
          aria-label="default-sidebar-0909" aria-labelledby="default-sidebar-0909">
          <div
            class="overflow-y-auto py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <ul class="space-y-2">
              <li>
                <a href="#"
                  class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg aria-hidden="true"
                    class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                  </svg>
                  <span class="ml-3">Overview</span>
                </a>
              </li>
              <li>
                <button type="button"
                  class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                  aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                  <svg aria-hidden="true"
                    class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                      clip-rule="evenodd"></path>
                  </svg>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Pages</span>
                  <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
                  </svg>
                </button>
                <ul id="dropdown-pages" class="hidden py-2 space-y-2">
                  <li>
                    <a href="#"
                      class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Settings</a>
                  </li>
                  <li>
                    <a href="#"
                      class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Kanban</a>
                  </li>
                  <li>
                    <a href="#"
                      class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Calendar</a>
                  </li>
                </ul>
              </li>
              <li>
                <button type="button"
                  class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                  aria-controls="dropdown-sales" data-collapse-toggle="dropdown-sales">
                  <svg aria-hidden="true"
                    class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                      clip-rule="evenodd"></path>
                  </svg>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Sales</span>
                  <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
                  </svg>
                </button>
                <ul id="dropdown-sales" class="hidden py-2 space-y-2">
                  <li>
                    <a href="#"
                      class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Products</a>
                  </li>
                  <li>
                    <a href="#"
                      class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Billing</a>
                  </li>
                  <li>
                    <a href="#"
                      class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Invoice</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#"
                  class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg aria-hidden="true"
                    class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                    </path>
                    <path
                      d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                    </path>
                  </svg>
                  <span class="flex-1 ml-3 whitespace-nowrap">Messages</span>
                  <span
                    class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-blue-800 bg-blue-100 dark:bg-blue-200 dark:text-blue-800">
                    6
                  </span>
                </a>
              </li>
              <li>
                <button type="button"
                  class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                  aria-controls="dropdown-authentication" data-collapse-toggle="dropdown-authentication">
                  <svg aria-hidden="true"
                    class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                      clip-rule="evenodd"></path>
                  </svg>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Authentication</span>
                  <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
                  </svg>
                </button>
                <ul id="dropdown-authentication" class="hidden py-2 space-y-2">
                  <li>
                    <a href="#"
                      class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Sign
                      In</a>
                  </li>
                  <li>
                    <a href="#"
                      class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Sign
                      Up</a>
                  </li>
                  <li>
                    <a href="#"
                      class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Forgot
                      Password</a>
                  </li>
                </ul>
              </li>
            </ul>
            <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
              <li>
                <a href="#"
                  class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                  <svg aria-hidden="true"
                    class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                    <path fill-rule="evenodd"
                      d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                      clip-rule="evenodd"></path>
                  </svg>
                  <span class="ml-3">Docs</span>
                </a>
              </li>
              <li>
                <a href="#"
                  class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                  <svg aria-hidden="true"
                    class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                    </path>
                  </svg>
                  <span class="ml-3">Components</span>
                </a>
              </li>
              <li>
                <a href="#"
                  class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                  <svg aria-hidden="true"
                    class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z"
                      clip-rule="evenodd"></path>
                  </svg>
                  <span class="ml-3">Help</span>
                </a>
              </li>
            </ul>
          </div>
          <div
            class="hidden absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex bg-white dark:bg-gray-800 z-20 border-r border-gray-200 dark:border-gray-700">
            <a href="#"
              class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-600">
              <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                </path>
              </svg>
            </a>
            <a href="#" data-tooltip-target="tooltip-settings"
              class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
              <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                  clip-rule="evenodd"></path>
              </svg>
            </a>
            <div id="tooltip-settings" role="tooltip"
              class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
              Settings page
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <button type="button" data-dropdown-toggle="language-dropdown"
              class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:hover:text-white dark:text-gray-400 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
              <svg aria-hidden="true" class="h-5 w-5 rounded-full mt-0.5" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 3900 3900">
                <path fill="#b22234" d="M0 0h7410v3900H0z" />
                <path d="M0 450h7410m0 600H0m0 600h7410m0 600H0m0 600h7410m0 600H0" stroke="#fff" stroke-width="300" />
                <path fill="#3c3b6e" d="M0 0h2964v2100H0z" />
                <g fill="#fff">
                  <g id="d">
                    <g id="c">
                      <g id="e">
                        <g id="b">
                          <path id="a" d="M247 90l70.534 217.082-184.66-134.164h228.253L176.466 307.082z" />
                          <use xlink:href="#a" y="420" />
                          <use xlink:href="#a" y="840" />
                          <use xlink:href="#a" y="1260" />
                        </g>
                        <use xlink:href="#a" y="1680" />
                      </g>
                      <use xlink:href="#b" x="247" y="210" />
                    </g>
                    <use xlink:href="#c" x="494" />
                  </g>
                  <use xlink:href="#d" x="988" />
                  <use xlink:href="#c" x="1976" />
                  <use xlink:href="#e" x="2470" />
                </g>
              </svg>
            </button>
            <!-- Dropdown -->
            <div
              class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
              id="language-dropdown">
              <ul class="py-1" role="none">
                <li>
                  <a href="#"
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:text-white dark:text-gray-300 dark:hover:bg-gray-600"
                    role="menuitem">
                    <div class="inline-flex items-center">
                      <svg aria-hidden="true" class="h-3.5 w-3.5 rounded-full mr-2" xmlns="http://www.w3.org/2000/svg"
                        id="flag-icon-css-us" viewBox="0 0 512 512">
                        <g fill-rule="evenodd">
                          <g stroke-width="1pt">
                            <path fill="#bd3d44"
                              d="M0 0h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0z"
                              transform="scale(3.9385)" />
                            <path fill="#fff"
                              d="M0 10h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0z"
                              transform="scale(3.9385)" />
                          </g>
                          <path fill="#192f5d" d="M0 0h98.8v70H0z" transform="scale(3.9385)" />
                          <path fill="#fff"
                            d="M8.2 3l1 2.8H12L9.7 7.5l.9 2.7-2.4-1.7L6 10.2l.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7L74 8.5l-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 7.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 24.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 21.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 38.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 35.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 52.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 49.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 66.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 63.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9z"
                            transform="scale(3.9385)" />
                        </g>
                      </svg>
                      English (US)
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#"
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-600"
                    role="menuitem">
                    <div class="inline-flex items-center">
                      <svg aria-hidden="true" class="h-3.5 w-3.5 rounded-full mr-2" xmlns="http://www.w3.org/2000/svg"
                        id="flag-icon-css-de" viewBox="0 0 512 512">
                        <path fill="#ffce00" d="M0 341.3h512V512H0z" />
                        <path d="M0 0h512v170.7H0z" />
                        <path fill="#d00" d="M0 170.7h512v170.6H0z" />
                      </svg>
                      Deutsch
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#"
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-600"
                    role="menuitem">
                    <div class="inline-flex items-center">
                      <svg aria-hidden="true" class="h-3.5 w-3.5 rounded-full mr-2" xmlns="http://www.w3.org/2000/svg"
                        id="flag-icon-css-it" viewBox="0 0 512 512">
                        <g fill-rule="evenodd" stroke-width="1pt">
                          <path fill="#fff" d="M0 0h512v512H0z" />
                          <path fill="#009246" d="M0 0h170.7v512H0z" />
                          <path fill="#ce2b37" d="M341.3 0H512v512H341.3z" />
                        </g>
                      </svg>
                      Italiano
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#"
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:text-white dark:text-gray-300 dark:hover:bg-gray-600"
                    role="menuitem">
                    <div class="inline-flex items-center">
                      <svg aria-hidden="true" class="h-3.5 w-3.5 rounded-full mr-2" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" id="flag-icon-css-cn" viewBox="0 0 512 512">
                        <defs>
                          <path id="a" fill="#ffde00" d="M1-.3L-.7.8 0-1 .6.8-1-.3z" />
                        </defs>
                        <path fill="#de2910" d="M0 0h512v512H0z" />
                        <use width="30" height="20" transform="matrix(76.8 0 0 76.8 128 128)" xlink:href="#a" />
                        <use width="30" height="20" transform="rotate(-121 142.6 -47) scale(25.5827)" xlink:href="#a" />
                        <use width="30" height="20" transform="rotate(-98.1 198 -82) scale(25.6)" xlink:href="#a" />
                        <use width="30" height="20" transform="rotate(-74 272.4 -114) scale(25.6137)" xlink:href="#a" />
                        <use width="30" height="20" transform="matrix(16 -19.968 19.968 16 256 230.4)" xlink:href="#a" />
                      </svg>
                      中文 (繁體)
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </aside>
      </nav>
    </header>

    <!-- Main -->
    <main class="h-auto">

      <slot />
      <Footer />
    </main>

    <Alert />
  </div>
</template>

<script setup>
import Alert from '@/Components/Alert.vue';
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import UserIcon from '@/Components/Icons/UserIcon.vue';
import CartIcon from '@/Components/Icons/CartIcon.vue';
import Footer from '@/Components/Frontend/Footer.vue';
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/Frontend/NavLink.vue';

import { useCartStore } from '@/Store/cart';
import { storeToRefs } from 'pinia';
import Logo from '@/Components/Frontend/Svg/Logo.vue';

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

onMounted(() => {
  initFlowbite();
});

</script>

<style lang="scss" scoped></style>