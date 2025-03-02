<template>

<h1 class="text-3xl mb-4">Your Comments</h1>
  <section class="grid grid-cols-1 lg:grid-cols-3 gap-2">
    <template v-if="comments.data.length">
        <Comment v-for="(comment) in comments.data" :key="comment.id" :comment="comment" :from-index-comment="true"></Comment>
    </template>
    <template v-else>
        You have no comments :)
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
        comments:Array,
    }
);
import Comment from '../Post/Components/Comment.vue';
import Pagination from '@/Components/UI/Pagination.vue';
</script>