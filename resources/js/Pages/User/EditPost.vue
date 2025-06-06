<template>
    <section class="bg-white dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Post</h2>
      <form @submit.prevent.stop="submitHandler">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <div class="sm:col-span-2">
                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post Title</label>
                  <input v-model="form.title" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type Post Title" required>
                    <div class="input-error">{{ form.errors.title }}</div>
                </div>
              <div class="sm:col-span-2">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                  <textarea  v-model="form.description" id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here" required></textarea>
                    <div class="input-error">{{ form.errors.description }}</div>
                </div>
          </div>
             <div class="flex gap-3">
                    <button type="submit" class="mt-6 btn-primary disabled:cursor-not-allowed" :disabled="utilityStore.isProcessing || isFetching">
                     <span v-if="!utilityStore.isProcessing || !isFetching">Edit</span>
                     <EyeLoader v-else></EyeLoader>
                    </button>
                    <button   type="button"
                    class="mt-6 btn-danger" @click="form.reset()">
                        reset
                    </button>
                </div>
      </form>
  </div>
</section>
</template>
<script setup>
import { useCategoryApiDealing } from '@/Composables/CategoryApiDealing';
import { useUtilityStore } from '@/Store/utility';
import EyeLoader from '@/Components/Loaders/EyeLoader.vue';
const utilityStore = useUtilityStore();
const props = defineProps({
    post: Object
})

async function submitHandler() {
    try {
        utilityStore.fetchError = false;
        utilityStore.isProcessing = true;
        await categoryApiCall();
        form.put(`/user/post/${props.post.id}`);
        utilityStore.isProcessing = false;
        form.reset()
    }
    catch (error) {
        utilityStore.isProcessing = false;
        //console.error('Error during form submission or API call:', error);
    }
}
const { form, categoryApiCall, isFetching } = useCategoryApiDealing(props);
</script>