<template>
<main class="bg-white pt-8 pb-16 antialiased lg:pt-16 lg:pb-24 dark:bg-gray-900">
  <div class="mx-auto flex max-w-screen-xl justify-between px-4">
    <article class="prose prose-sm sm:prose-base lg:prose-lg dark:prose-invert mx-auto w-full max-w-2xl">
        <header class="mb-4 lg:mb-6">
        <div class="flex justify-between items-start gap-4">
        <h1 class="mb-4 text-3xl font-extrabold text-gray-900 lg:mb-6 lg:text-4xl dark:text-white flex-1">
        {{ post.title }}
        </h1>
        <dropdown v-if="sessionState.user?.id === post.user_id" :editRoute="`/user/post/${post.id}/edit`" :deleteRoute="`/user/post/${post.id}`" type="Post"/>
        </div>
        <div class="mt-2 mb-2 flex space-x-2">
         <span class="rounded-full border border-emerald-900 px-2.5 py-0.5 text-xs whitespace-nowrap text-emerald-700 text-center">
           {{ post.category_one }}
         </span>
         <span class="rounded-full border border-emerald-900 px-2.5 py-0.5 text-xs whitespace-nowrap text-emerald-700 text-center">
           {{ post.category_two }}
         </span>
       </div>
        <address class="mb-6 flex items-center not-italic">
          <div class="mr-3 inline-flex items-center">
            <div>
              <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">By {{post.user.first_name+' '+post.user.last_name}}</a>
              <p class="text-base text-gray-500 dark:text-gray-400">
                <UseTimeAgo v-slot="{ timeAgo }" :time="new Date(post.created_at)">
                  {{ timeAgo }}
               </UseTimeAgo> 
              </p>
            </div>
          </div>
        </address>
      </header>

      <p class="text-xl text-gray-700 dark:text-gray-300">{{ post.description }}</p>
  

      <!-- Comment Section -->
      <section>
        <div class="mt-6 mb-3 flex items-center justify-between">
          <h2 class="text-lg font-bold text-gray-900 lg:text-2xl dark:text-white">Discussion ({{ post.comments.length }})</h2>
        </div>
        <form @submit.prevent.stop="utilityStore.createComment(post.id)" class="mb-6">
          <div class="mb-4">
            <!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->

            <div>
              <label for="OrderNotes" class="sr-only">Order notes</label>

              <div class="overflow-hidden">
                <textarea v-model="utilityStore.commentForm.description" id="OrderNotes" class="w-full resize-none border-x-0 border-t-0 border-gray-200 px-0 align-top sm:text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" rows="4" placeholder="write a comment" required></textarea>

                <div class="flex items-center justify-end gap-2 py-3">
                  <button type="reset" class="btn-outline">Clear</button>

                  <button type="submit" class="btn-primary" :disabled="utilityStore.isProcessing">
                    <span v-if="!utilityStore.isProcessing">Add</span>
                    <span v-else>Adding</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <template v-if="post.comments.length">
          <ActivityBlock v-for="(comment) in post.comments" :key="comment.id" :data="comment" from-show></ActivityBlock>
        </template>
        <template v-else>
          Be the first to comment !!!
        </template>

</section>
</article>
</div>
</main>
</template>
<script setup>
import { defineProps } from 'vue';
import dropdown from '@/Components/soph/dropdown.vue';
import { useSessionStore } from '@/Store/sessionstate';
import { useUtilityStore } from '@/Store/utility';
import { UseTimeAgo } from '@vueuse/components';
import ActivityBlock from './Components/ActivityBlock.vue';
const props = defineProps({
    post:Object,
})
const sessionState = useSessionStore();
const utilityStore = useUtilityStore();


</script>