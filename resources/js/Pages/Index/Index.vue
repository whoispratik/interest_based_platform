<template>
  <section class="bg-white dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
          <div class="max-w-screen-md">
              <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Uncover What Truly Moves You</h2>
              <p class="mb-8 font-light text-gray-500 sm:text-xl dark:text-gray-400">Your interests shape your world, and our platform helps you explore them effortlessly. By understanding your interactions—likes, comments, and posts—we curate a feed that evolves with you, connecting you with content that truly resonates. Whether you're passionate about technology, art, business, or unique niche topics, we help you dive deeper and discover more. Start exploring today and let your curiosity lead the way </p>
              <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                  <Link href="/user/post" class="inline-flex items-center justify-center  bg-emerald-600 dark:bg-emerald-800 dark:hover:bg-emerald-700 hover:bg-emerald-500 text-white font-medium p-2 rounded-md;">
                      Get started
                  </Link>
                  <Link href="/post" class="inline-flex items-center justify-center px-4 py-2.5 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                      View Posts
                  </Link>  
              </div>
          </div>
      </div>
  </section>

  </template>
  <script setup>
import { Link } from '@inertiajs/vue3';
</script>