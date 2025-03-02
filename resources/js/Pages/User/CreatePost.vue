<template>
    <section class="bg-white dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Create Post</h2>
      <form @submit.prevent.stop="post">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <div class="sm:col-span-2">
                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post Title</label>
                  <input v-model="form.title" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type Post Title" required>
              </div>
              <div class="sm:col-span-2">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                  <textarea  v-model="form.description" id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here" required></textarea>
              </div>
          </div>
             <div class="flex gap-3">
                 <button type="submit" class="mt-6 btn-primary" :disabled="utilityStore.isProcessing">
                     <span v-if="!utilityStore.isProcessing">Post</span>
                     <span v-else>processing</span>
                    </button>
                    <button type="reset" class="mt-6 btn-danger">
                        clear
                    </button>
                </div>
      </form>
  </div>
</section>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3'
import { useUtilityStore } from '@/Store/utility';
const utilityStore = useUtilityStore()
const form=useForm({
  title: '',
  description: '',
  subreddit : '',
  category_one : '',
  category_two : '',
})
async function post(){
    utilityStore.isProcessing = true;
    await categoryApiCall();
    form.post('/user/post');
    utilityStore.isProcessing = false;
    if(!utilityStore.isProcessing)
    form.reset();
}
async function categoryApiCall(){
    let data = {
    title : form.title,
    description : form.description,
  }
    let response = await fetch('http://127.0.0.1:9000/predict_category', {
        method: 'POST',
        headers: {
       'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
        });
    const result = await response.json(); // Parse JSON from the response
    console.log(result);
    form.subreddit = result.predicted_subreddit;
    form.category_one = result.category_1;
    form.category_two = result.category_2;
}
</script>