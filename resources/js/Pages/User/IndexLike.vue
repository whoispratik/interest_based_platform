<template>

<h1 class="text-3xl mb-4">Your Likes</h1>
  <section class="grid grid-cols-1  gap-2">
    <template v-if="likes.data.length">
        <ActivityBlock v-for="(like) in likes.data" :key="like.id" :data="like" for-like></ActivityBlock>
    </template>
    <template v-else>
        You have not made any likes :)
    </template>
</section>
    <div
v-if="likes.data.length"
class="w-full flex justify-center mt-8 mb-8"
    >
    <Pagination :links="likes.links"></Pagination>
    </div>
</template>

<script setup>
import Pagination from '@/Components/UI/Pagination.vue';
import ActivityBlock from '../Post/Components/ActivityBlock.vue';
const props = defineProps({
    likes: Object,
});
</script>

