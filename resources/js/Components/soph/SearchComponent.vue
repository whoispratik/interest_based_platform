<template>
<div class="px-2 py-2">
    <div class="flex">
      <div class="flex relative w-full max-w-md rounded-md">
        <input
          v-model="form.q"
          type="search"
          name="q"
          id="query"
          placeholder="Search by title, description, category, interest..."
          class="w-full py-2 px-3 rounded-l-md border-2  placeholder-gray-500
                 dark:placeholder-gray-400 dark:bg-gray-700 dark:text-gray-200"
        />
        <button
          class="inline-flex items-center gap-1 bg-emerald-600 text-white text-sm font-medium
                 py-2 px-4 rounded-r-md"
                 @click="searchPosts"
        >
          <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
               viewBox="0 0 56.966 56.966">
            <path
              d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23 
                 s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208
                 c0.571,0.593,1.339,0.92,2.162,0.92c0.779,0,1.518-0.297,2.079-0.837
                 C56.255,54.982,56.293,53.08,55.146,51.887z
                 M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17s-17-7.626-17-17
                 S14.61,6,23.984,6z"
            />
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>
<script setup>
/* this is not a humble component like accepting props and emiting events i have left out the emiting part for obvious reasons*/
import { useForm } from '@inertiajs/vue3';
const props = defineProps({
    controllerRoute: String,
    filters:{
        type: Object,
        required: true
    }
})
const form = useForm({
    q: props.filters.q ?? null, 
});

function searchPosts(){
    form.get(props.controllerRoute, {
        preserveScroll: true,
    })
}
</script>