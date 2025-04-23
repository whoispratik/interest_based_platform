<template>
    <button :disabled="!isInterestEligibile" @click="$emit('interestApiCall')">
    <span v-if="isFetching && !isFinished">Updating...</span>
    <span v-else-if="interests">Recalibrate Interests</span>
    <span v-else>Predict Interests</span>
    </button>
</template>
<script setup>
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