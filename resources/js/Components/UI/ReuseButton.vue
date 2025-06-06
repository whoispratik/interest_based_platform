<template>
    <button :disabled="!isInterestEligibile || isFetching" @click="$emit('interestApiCall')">
    <EyeLoader v-if="isFetching && !isFinished"></EyeLoader>
    <span v-else-if="interests">Recalibrate Interests</span>
    <span v-else>Predict Interests</span>
    </button>
</template>
<script setup>
import EyeLoader from '../Loaders/EyeLoader.vue';
defineProps({
    isInterestEligibile: {
        type: Boolean,
        required: true,
    },
    interests: {
        type: [Object, null],
        required: true,
    },
    isFetching: {
        type: Boolean,
        required: true,
    },
    isFinished: {
        type: Boolean,
        required: true,
    }
})
defineEmits(['interestApiCall']);
</script>