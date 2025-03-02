<template>
    <div class="flex gap-1">
        <template v-for="(link, index) in links" :key="index">
            <Link
                v-if="link.url"
                class="py-2 px-4 rounded-md"
                :href="link.url"
                :class="{
                    ' bg-emerald-600 dark:bg-emerald-800 text-gray-300':
                        link.active,
                }"
                v-html="link.label"
                as="button"
                :disabled="link.active"
            />
        </template>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    links: Array,
});
</script>
