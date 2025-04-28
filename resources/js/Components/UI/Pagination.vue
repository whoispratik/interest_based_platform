<template>
  <div class="w-full overflow-x-auto py-2">
    <!-- “w-max” keeps us only as wide as we need, “mx-auto” centers when < parent width -->
    <div class="inline-flex gap-1 w-max mx-auto">
      <template v-for="(link, i) in links" :key="i">
        <Link
          v-if="link.url"
          as="button"
          :href="link.url"
          :disabled="link.active"
          class="py-2 px-4 rounded-md whitespace-nowrap"
          :class="{ 'bg-emerald-600 dark:bg-emerald-800 text-gray-300': link.active }"
          v-html="link.label"
        />
      </template>
    </div>
  </div>
</template>
   
<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    links: Array,
});
</script>
