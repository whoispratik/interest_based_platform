<template>
    <button @click="openDeleteModal" class="block px-4 py-2 text-sm text-gray-5" role="menuitem">
      Sign Out
    </button>
    <SignOutModal v-if="showDeleteModal" :delete-route="deleteRoute" @close="closeDeleteModal"></SignOutModal>
</template>
<script setup>
   import { useToggle } from '@/Composables/toggle';
   import SignOutModal from '../UI/SignOutModal.vue';
   const props = defineProps({
     deleteRoute: String,
   });
   const {showDeleteModal,closeDeleteModal,openDeleteModal,} = useToggle();
   
</script>
   