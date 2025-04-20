// toggle.js
import { ref} from 'vue';
export function useToggle() {

   const showOptions = ref(false);
   const showDeleteModal = ref(false);

  function toggleOptions() {
    showOptions.value = !showOptions.value;
  }

  function openDeleteModal() {
    showOptions.value = false;
    showDeleteModal.value = true;
  }

  function closeDeleteModal() {
    showDeleteModal.value = false;
  }

  return {
    showDeleteModal,
    showOptions,
    toggleOptions,
    openDeleteModal,
    closeDeleteModal
  };
}