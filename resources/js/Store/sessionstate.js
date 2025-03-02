import { defineStore } from 'pinia';
import { usePage } from '@inertiajs/vue3';
export const useSessionStore = defineStore('session', {
  state:() =>
  ({
    page: usePage(),
  }),
  getters:{
    user(state){
        return state.page.props.user;
    }
  }
});