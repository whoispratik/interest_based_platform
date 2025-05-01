<template>
 <div class="relative inline-block text-left">
    <button @click="openDeleteModal" class="flex items-center space-x-1.5 p-1 group">
  <svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    aria-label="Close"
    class="h-4 w-4 fill-current transition duration-300 ease-in-out transform group-active:scale-110
    text-red-700
     group-hover:text-red-500"
  >
    <path
      fill-rule="evenodd"
      clip-rule="evenodd"
      d="M4.293 4.293a1 1 0 011.414 0L12 10.586l6.293-6.293a1 1 0 
         111.414 1.414L13.414 12l6.293 6.293a1 1 0 
         01-1.414 1.414L12 13.414l-6.293 6.293a1 1 0 
         01-1.414-1.414L10.586 12 4.293 5.707a1 1 0 010-1.414z"
    />
  </svg>
</button>
<DeleteModal v-if="showDeleteModal" :type="type" :delete-route="deleteRoute" @close="closeDeleteModal"></DeleteModal>
 </div>
</template>

<script setup>
import DeleteModal from '../UI/DeleteModal.vue';
import { useToggle } from '@/Composables/toggle';
const props = defineProps({
  deleteRoute: String,
  type: String,
});
const {showDeleteModal,closeDeleteModal,openDeleteModal,} = useToggle();

</script>
