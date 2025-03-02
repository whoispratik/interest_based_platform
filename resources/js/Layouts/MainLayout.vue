<template>
<NavBar></NavBar>
<main class="container mx-auto p-4 w-full">
<div
v-if="flashSuccess"
 class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2"
>
{{ flashSuccess }}
</div>
<div
v-if="error"
class="mb-4 border rounded-md shadow-sm border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900 p-2"
>
{{ error }}
</div>
        <slot>Default</slot>
</main>
</template>

<script setup>
import NavBar from '../Components/UI/NavBar.vue';
import {  usePage } from "@inertiajs/vue3";
import { computed, watch } from "vue";

const page = usePage();

const flashSuccess = computed(() => page.props.flash.success);
const error = computed(() => page.props.flash.error);


watch(error, (value) => {
    if (value) {
        setTimeout(() => {
            page.props.flash.error = null;
        }, 5000);
    }
},
{ immediate: true });

watch(flashSuccess, (value) => {
    if (value) {
        setTimeout(() => {
            page.props.flash.success = null;
        }, 5000);
    }
});

</script>
