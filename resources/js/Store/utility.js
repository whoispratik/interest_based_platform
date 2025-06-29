import { defineStore } from 'pinia';
import { useForm } from '@inertiajs/vue3';
import { useSessionStore } from './sessionstate';
import {watch} from 'vue';
export const useUtilityStore = defineStore('utility', {
  state:() =>
  ({
    isProcessing: false,
    commentForm: useForm({
        description: ''
    }),
    fetchError: false,
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
    },
    checkLiked(postLikes){
      const id = useSessionStore().user?.id;
      return postLikes.find(like => like.user_id === id);
    },
    checkCommented(postComments){
      const id = useSessionStore().user?.id;
      return postComments.find(comment => comment.user_id === id);
    },
  }
});


