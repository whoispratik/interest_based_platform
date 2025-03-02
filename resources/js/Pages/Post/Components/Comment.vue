<template>
       <article class="mb-6 rounded-lg bg-white p-6 text-base dark:bg-gray-900 border-b-1 border-indigo-300">
          <footer class="mb-2 flex items-center justify-between">
            <div class="flex-col items-center">
              <p class="mr-3 inline-flex items-center text-sm font-semibold text-gray-900 dark:text-white">
               <template v-if="fromIndexComment"><Link :href="`/post/${comment.post_id}`" class="post-link"> See Post</Link></template>
                <template v-else>
                  {{ comment.user.first_name + "" + comment.user.last_name }}
                </template>
              </p>
              <p class=" text-xs md:text-sm text-gray-600 dark:text-gray-400">
                <UseTimeAgo v-slot="{ timeAgo }" :time="new Date(comment.created_at)">
                    {{ timeAgo}}
                </UseTimeAgo> </p>
            </div>
            <!-- WARNING: This dropdown requires custom JavaScript -->
            <button class="inline-flex items-center rounded-lg p-2 text-sm">
              <!-- SVG remains -->
                <dropdown :edit-route="`/user/comment/${comment.id}/edit`" :delete-route="`/user/comment/${comment.id}`" type="comment" v-if="sessionStore.user.id === comment.user_id"></dropdown>
            </button>
          </footer>
          <p class="text-gray-700 dark:text-gray-300">{{ comment.description }}</p>
        </article>
</template>
<script setup>
import dropdown from '@/Components/soph/dropdown.vue';
import { UseTimeAgo } from '@vueuse/components';
import { useSessionStore } from '@/Store/sessionstate';
import { Link } from '@inertiajs/vue3';
const sessionStore = useSessionStore();
const props = defineProps({
    comment: Object,
    fromIndexComment: {
        type: Boolean,
        default: false,
    },
})
</script>