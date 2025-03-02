<template>
    <div class="relative flex items-center justify-center p-4">
      <button @click="toggleDropdown"
        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
        Filter by category
        <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
  
      <!-- Dropdown menu -->
      <div v-if="isDropdownOpen"
           class="absolute z-10 w-56 p-3 mt-2 bg-white rounded-lg shadow dark:bg-gray-700">
        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
          Category
        </h6>
        <ul class="space-y-2 text-sm">
          <li class="flex items-center">
            <input id="apple" type="checkbox"
              class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
            <label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
              Apple (56)
            </label>
          </li>
          <li class="flex items-center">
            <input id="fitbit" type="checkbox"
              class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
            <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
              Fitbit (56)
            </label>
          </li>
          <li class="flex items-center">
            <input id="dell" type="checkbox"
              class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
            <label for="dell" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
              Dell (56)
            </label>
          </li>
          <li class="flex items-center">
            <input id="asus" type="checkbox" checked
              class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
            <label for="asus" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
              Asus (97)
            </label>
          </li>
          <li class="flex items-center">
            <input id="logitech" type="checkbox" checked
              class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
            <label for="logitech" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
              Logitech (97)
            </label>
          </li>
          <li class="flex items-center">
            <input id="msi" type="checkbox" checked
              class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
            <label for="msi" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
              MSI (97)
            </label>
          </li>
          <li class="flex items-center">
            <input id="bosch" type="checkbox" checked
              class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
            <label for="bosch" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
              Bosch (176)
            </label>
          </li>
          <li class="flex items-center">
            <input id="sony" type="checkbox"
              class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
            <label for="sony" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
              Sony (234)
            </label>
          </li>
          <li class="flex items-center">
            <input id="samsung" type="checkbox" checked
              class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
            <label for="samsung" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
              Samsung (76)
            </label>
          </li>
          <li class="flex items-center">
            <input id="canon" type="checkbox"
              class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
            <label for="canon" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
              Canon (49)
            </label>
          </li>
          <li class="flex items-center">
            <input id="microsoft" type="checkbox"
              class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
            <label for="microsoft" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
              Microsoft (45)
            </label>
          </li>
          <li class="flex items-center">
            <input id="razor" type="checkbox"
              class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
            <label for="razor" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
              Razor (49)
            </label>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'CategoryDropdown',
    data() {
      return {
        isDropdownOpen: false
      }
    },
    methods: {
      toggleDropdown() {
        this.isDropdownOpen = !this.isDropdownOpen;
      }
    }
  }
  </script>
  
  <style scoped>
  /* Optional: Add any custom styling you need here */
  </style>
  