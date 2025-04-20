<template>
  <h1 class="text-3xl mb-4">Your Posts</h1>
  <section class="grid grid-cols-1 lg:grid-cols-3 gap-2">
    <template v-if="posts.data.length>=1">
        <Box v-for="(post,index) in posts.data"
:key="index"
:postRoute="`/post/${post.id}`"
:addLikeRoute="`/post/${post.id}/like`"
:postLikes="post.likes"
:postComments="post.comments"
>
<template #user>{{post.user.first_name+' '+post.user.last_name}}</template>
<template #timestamp>   <UseTimeAgo v-slot="{ timeAgo }" :time="new Date(post.created_at)">
    {{ timeAgo }}
  </UseTimeAgo>  </template>
<template #title>{{ post.title }}</template>
<template #description>{{ utilityStore.truncateTo25Words(post.description) }}</template>
<template #category_one>{{ post.category_one }}</template>
<template #category_two>{{ post.category_two }}</template>
<template #commentsCount>{{ post.comments_count }}</template>
<template #likesCount>{{ post.likes_count }}</template>
</Box>
    </template>
    <template v-else>
        you have no posts :(
    </template>
  </section>
  <div
v-if="posts.data.length"
class="w-full flex justify-center mt-8 mb-8"
    >
    <Pagination :links="posts.links"></Pagination>
    </div>
</template>
<script setup>
import Box from '@/Components/UI/Box.vue';
import Pagination from '@/Components/UI/Pagination.vue';
import { useUtilityStore } from '@/Store/utility';
import { UseTimeAgo } from '@vueuse/components';
const utilityStore = useUtilityStore();
const props = defineProps({
    posts:Object
})

</script>