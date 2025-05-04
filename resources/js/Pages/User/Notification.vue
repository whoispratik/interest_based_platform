<template>
  <div class="p-6 space-y-6">
    <!-- Header with bulk actions -->
    <div class="flex justify-between items-center">
      <h1 class="text-3xl font-semibold">Your Notifications</h1>
      <div class="space-x-2">
        <Link
          href="/user/notification/mark-all-as-read"
          method="put"
          as="button"
          @click.prevent="markAllAsRead"
          :disabled="allRead"
          class="btn-outline disabled:opacity-50 disabled:cursor-not-allowed"
        >
          Mark All Read
        </Link>
      </div>
    </div>

    <!-- Filter buttons -->
    <div class="flex space-x-2">
      <button
        @click="filter = 'all'"
        :class="filter === 'all'
          ? 'px-3 py-1 border border-emerald-600 text-emerald-600 rounded'
          : 'px-3 py-1 text-gray-600 hover:text-gray-800 rounded'"
      >All</button>
      <button
        @click="filter = 'unread'"
        :class="filter === 'unread'
          ? 'px-3 py-1 border border-emerald-600 text-emerald-600 rounded'
          : 'px-3 py-1 text-gray-600 hover:text-gray-800 rounded'"
      >Unread</button>
    </div>

    <!-- Notification list -->
    <section v-if="notifications.data.length" class="space-y-4">
      <div
        v-for="notification in notifications.data"
        :key="notification.id"
        class="flex justify-between items-center p-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition"
      >
        <!-- Notification text -->
        <div>
          <p class="text-sm text-gray-800 dark:text-gray-200">
            {{ notification.data.userName }}
            <span v-if="notification.type === 'App\\Notifications\\CommentMade'">
              commented on your
            </span>
            <span v-else-if="notification.type === 'App\\Notifications\\LikeMade'">
              liked your
            </span>
            <Link
              :href="`/post/${notification.data.postId}`"
              class="text-emerald-600 dark:text-emerald-400 underline"
            >
              post
            </Link>
          </p>
          <p class="text-xs text-gray-500 dark:text-gray-400">
            {{ useTimeAgo(notification.created_at) }}
          </p>
        </div>

        <!-- Actions: mark read or status + delete -->
        <div class="flex items-center space-x-4">
          <Link
            v-if="!notification.read_at"
            :href="`/user/notification/${notification.id}`"
            method="put"
            as="button"
            class="text-red-400 underline hover:text-red-600"
          >
            mark as read
          </Link>
          <span
            v-else
            class="text-xs italic text-gray-500 dark:text-gray-400"
          >
            Read
          </span>

          <!-- Delete button -->
          <button
            @click="deleteOne(notification.id)"
            class="p-1 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition"
            title="Delete notification"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 hover:text-red-700" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M8 2a1 1 0 00-.894.553L6.382 4H4a1 1 0 100 2h1v10a2 2 0 002 2h6a2 2 0 002-2V6h1a1 1 0 100-2h-2.382l-.724-1.447A1 1 0 0012 2H8zM8 6a1 1 0 012 0v8a1 1 0 11-2 0V6zm4 0a1 1 0 012 0v8a1 1 0 11-2 0V6z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
    </section>

    <!-- Empty state -->
    <div v-else class="text-center py-12 text-gray-500 dark:text-gray-400">
      <span class="text-2xl" v-if="filter === 'unread'">
        No unread notifications yet.
      </span>
      <span class="text-2xl" v-else>
        No notifications yet.
      </span>
    </div>

    <!-- Pagination -->
    <section v-if="notifications.links.length" class="pt-6">
      <Pagination :links="notifications.links" />
    </section>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import Pagination from '@/Components/UI/Pagination.vue'
import { useTimeAgo } from '@vueuse/core'

const props = defineProps({
  notifications: {
    type: Object,
    required: true,
  },
  filter: {
    type: String,
    required: true,
  }
})

// filter state
const filter = ref(props.filter ?? 'unread')

watch(filter, (newFilter) => {
  router.get('/user/notification', { filter: newFilter });
})
onMounted(() => {
  console.log('notification component fucking mounted');
})
// check if all are read
const allRead = computed(() =>
  props.notifications.data.every(n => n.read_at)
)

// mark all as read action
const markAllAsRead = () => {
  router.put('/user/notification/mark-all-as-read')
}

// delete a single notification
const deleteOne = (id) => {
  if (!confirm('Are you sure you want to delete this notification?')) return
  router.delete(`/user/notification/${id}`)
}

</script>
