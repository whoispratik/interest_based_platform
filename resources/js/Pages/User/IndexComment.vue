<template>

<h1 class="text-3xl mb-4">Your Comments</h1>
  <section class="grid grid-cols-1 lg:grid-cols-3 gap-2">
    <template v-if="comments.data.length">
        <ActivityBlock v-for="(comment) in comments.data" :key="comment.id" :data="comment" for-comment></ActivityBlock>
    </template>
    <template v-else>
        You have not made any comments :)
    </template>
</section>
    <div
v-if="comments.data.length"
class="w-full flex justify-center mt-8 mb-8"
    >
    <Pagination :links="comments.links"></Pagination>
    </div>
</template>
<script setup>
const props = defineProps(
    {
        comments: Object,
    }
);
import ActivityBlock from '../Post/Components/ActivityBlock.vue';
import Pagination from '@/Components/UI/Pagination.vue';
</script>