<template>
  <SearchComponent :filters="filters" controller-route="/post"></SearchComponent>
  <template v-if="posts.data.length">

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
      <Box v-for="(post,index) in posts.data"
:key="post.id"
:postRoute="`/post/${post.id}`"
:addLikeRoute="`/post/${post.id}/like`"
:postLikes="post.likes"
:postComments="post.comments"
>
<template #user>{{post.user.first_name+' '+post.user.last_name}}</template>
<template #timestamp> <UseTimeAgo v-slot="{ timeAgo }" :time="new Date(post.created_at)">
    {{ timeAgo }}
  </UseTimeAgo> </template>
  <template #title>{{ post.title }}</template>
  <template #description>{{ truncateTo25Words(post.description) }}</template>
  <template #category_one>{{ post.category_one }}</template>
  <template #category_two>{{ post.subreddit }}</template>
  <template #commentsCount>{{ post.comments_count }}</template>
  <template #likesCount>{{ post.likes_count }}</template>
</Box>
</div>
<div
v-if="posts.data.length"
class="w-full flex justify-center mt-8 mb-8"
    >
    <Pagination :links="posts.links"></Pagination>
  </div>
</template>
<template v-else>
  we found nothing try searching something different :)
</template>
</template>
<script setup>
import Box from '../../Components/UI/Box.vue';
import Pagination from '../../Components/UI/Pagination.vue';
import SearchComponent from '@/Components/soph/SearchComponent.vue';
import { UseTimeAgo } from '@vueuse/components';
import { defineProps } from 'vue';
const props = defineProps({
    posts: Object,
    filters: Object
})
function truncateTo25Words(text) {
  const words = text.split(' ');
  if (words.length > 25) {
    return words.slice(0, 25).join(' ') + '...';
  }
  return text;
}
</script>