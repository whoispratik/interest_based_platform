<template>
    <div class="fixed top-10 right-4 max-w-xs w-full bg-red-500 text-white shadow-lg rounded-lg p-2 flex items-center space-x-3 transition-transform transform hover:scale-105">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M8.257 3.099c.366-.446.976-.446 1.342 0l6 7.5a1 1 0 01-.671 1.601H3.07a1 1 0 01-.671-1.601l6-7.5zM10 13a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" clip-rule="evenodd" />
    </svg>
    <div class="flex-1">
        <p class="font-bold">Error</p>
        <p class="text-sm">An error occurred. Please try again.</p>
    </div>
    <button class="text-white hover:text-gray-300 focus:outline-none" @click.stop = "utilityStore.fetchError = false">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
</div>
</template>
<script setup>
import { useUtilityStore } from '@/Store/utility';
const utilityStore = useUtilityStore();
</script>