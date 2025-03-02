import { defineStore } from 'pinia';

export const useToggleStore = defineStore('toggle', {
  state:() =>
  ({
    isOptionsToggled:false,
    isDeleteModalToggled: false,
  }),
  actions:{
    toggleIt(str){
        this[str] = !this[str];
    },
    falsifyIt(str){
        this[str] = false;
    },
    falsifyBoth(str1,str2){
        this[str1] = this[str2] = false;
    }
  }
});