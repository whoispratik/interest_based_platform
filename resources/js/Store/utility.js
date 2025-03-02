import { defineStore } from 'pinia';
import { useForm } from '@inertiajs/vue3';
export const useUtilityStore = defineStore('utility', {
  state:() =>
  ({
    isProcessing: false,
    commentForm: useForm({
        description: ''
    })
  }),
  actions: {
    truncateTo25Words(text) {
      const words = text.split(' ');
      if (words.length > 25) {
        return words.slice(0, 25).join(' ') + '...';
      }
      return text;
    },
    createComment(id){
      this.isProcessing = true;
      this.commentForm.post(`/post/${id}/comment`);
      this.isProcessing = false;
    }
  }
});