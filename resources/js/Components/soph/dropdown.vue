<template>
  <div class="relative inline-block text-left">
    <!-- Dropdown button -->
    <div>
      <button 
        @click="toggleOptions"
        type="button" 
        class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-sm font-medium">
        Options
        <svg class="-mr-1 size-4 text-gray-500 dark:text-gray-400" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
        </svg>
      </button>
    </div>

    <!-- Options menu -->
    <div v-if="showOptions" class="absolute right-0 z-10 mt-2 w-42 md:w-48 origin-top-right rounded-lg shadow-lg bg-white dark:bg-gray-800 focus:outline-none">
      <div class="p-1">
        <Link :href="editRoute" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700/50">
          Edit {{ type }}
        </Link>
        <a @click.prevent.stop="openDeleteModal" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700/50">
          Delete {{ type }}
        </a>
      </div>
    </div>

    <!-- Local Delete Modal -->
    <DeleteModal 
      v-if="showDeleteModal" 
      :deleteRoute="deleteRoute" 
      :type="type"
      @close="closeDeleteModal" />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import DeleteModal from '../UI/DeleteModal.vue';

const props = defineProps({
  editRoute: String,
  deleteRoute: String,
  type: String,
});

// Local state for options menu and delete modal
const showOptions = ref(false);
const showDeleteModal = ref(false);

function toggleOptions() {
  showOptions.value = !showOptions.value;
}

function openDeleteModal() {
  // Optionally hide the options menu before showing the modal
  showOptions.value = false;
  showDeleteModal.value = true;
}

function closeDeleteModal() {
  showDeleteModal.value = false;
}
</script>
