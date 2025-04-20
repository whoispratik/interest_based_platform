<template>
       <article class="mb-6 rounded-lg bg-white p-6 text-base dark:bg-gray-900 border-b-1 border-indigo-300">
          <footer class="mb-2 flex items-center justify-between">
            <div class="flex-col items-center">
              <p class="mr-3 inline-flex items-center text-sm font-semibold text-gray-900 dark:text-white">
               <template v-if="forComment || forLike"><Link :href="`/post/${data.post_id}`" class="post-link"> See Post</Link></template>
                <template v-else>
                  {{ data.user.first_name + "" + data.user.last_name }}
                </template>
              </p>
              <p class=" text-xs md:text-sm text-gray-600 dark:text-gray-400">
                <UseTimeAgo v-slot="{ timeAgo }" :time="new Date(data.created_at)">
                    {{ timeAgo}}
                </UseTimeAgo> </p>
            </div>
            <button class="inline-flex items-center rounded-lg p-2 text-sm">
              <!-- SVG remains -->
                <dropdown :edit-route="`/user/comment/${data.id}/edit`" :delete-route="`/user/comment/${data.id}`" type="comment" v-if="sessionStore.user?.id === data.user_id && !forLike"></dropdown>
                <DeleteResource v-else-if="forLike" :delete-route="`/post/${data.post_id}/like/${data.id}`" type="like"></DeleteResource>
            </button>
          </footer>
          <p class="text-gray-700 dark:text-gray-300" v-if="fromShow || forComment">{{ data.description }}</p>
        </article>
</template>
<script setup>
import dropdown from '@/Components/soph/dropdown.vue';
import DeleteResource from '@/Components/soph/DeleteResource.vue';
import { UseTimeAgo } from '@vueuse/components';
import { useSessionStore } from '@/Store/sessionstate';
import { Link } from '@inertiajs/vue3';
const sessionStore = useSessionStore();
const props = defineProps({
    data: Object,
    forComment: {
        type: Boolean,
      default: false,
    },
    forLike: {
        type: Boolean,
        default: false,
    },
    fromShow: {
        type: Boolean,
        default:false,
    }
})
</script>