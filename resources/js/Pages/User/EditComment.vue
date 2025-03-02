<template>
    <section class="bg-white dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Comment</h2>
      <form @submit.prevent.stop="post">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <div class="sm:col-span-2">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                  <textarea  v-model="form.description" id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here" required></textarea>
              </div>
          </div>
             <div class="flex gap-3">
                 <button type="submit" class="mt-6 btn-primary" :disabled="utilityStore.isProcessing">
                     <span v-if="!utilityStore.isProcessing">Edit</span>
                     <span v-else>processing</span>
                    </button>
                    <button type="reset" class="mt-6 btn-danger" @click="clear">
                        clear
                    </button>
                </div>
      </form>
  </div>
</section>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
import { useUtilityStore } from '@/Store/utility';
const utilityStore = useUtilityStore();
const props = defineProps({
    comment:Object
})
const form = useForm(
    {
        description: props.comment.description,
    }
);
function clear(){
      form.reset();
}
async function post(){
    utilityStore.isProcessing = true;
    form.put(`/user/comment/${props.comment.id}`);
    utilityStore.isProcessing = false;
}
</script>