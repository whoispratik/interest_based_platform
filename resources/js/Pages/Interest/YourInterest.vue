<template>
<section class="max-w-4xl mx-auto p-4">
  <!-- Header -->
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
    <h1 class="text-3xl mb-4 sm:mb-0">Your Interests</h1>
    <ReuseButton  :is-interest-eligibile="isEligibleForInterest" class="btn-outline disabled:opacity-50 disabled:cursor-not-allowed" :interests="interests" 
    @interest-api-call="interestApiCall" :is-fetching="isFetching" :is-finished="isFinished"/>
  </div>

  <!-- Accordion -->
  <div v-if="interests && isEligibleForInterest">
    <Accordion v-for="(value, key) in interests" :category="key" :interest="value" :key="kebabCase(key)" :id="`accordion-${kebabCase(key)}`" @interest-change="interestChangeHandler"></Accordion>
  </div>
  <p class="text-gray-500" v-else-if="!isEligibleForInterest">You have not interacted much, come back later after interacting enough</p>
  <p class="text-gray-500" v-else-if="isEligibleForInterest">You are eligible to predict your interest, click on the predict interest button </p>
 
  <!-- Confirm Button -->
  <div class="mt-6 text-center">
    <button class="btn-outline" v-if="interestChanged" @click="interestChangeControllerCall" :disabled="interestChangeFetching">
      <span v-if="interestChangeFetching">Updating...</span>
      <span>Confirm Interests</span>
    </button>
    
  </div>
</section>

</template>

<script setup>
import Accordion from '@/Components/UI/Accordion.vue';
import ReuseButton from '@/Components/UI/ReuseButton.vue';
import { kebabCase } from 'lodash';
import { useYourInterest } from '@/Composables/YourInterestComposable';
const props = defineProps({
  userPosts: Array,
  userLikes: Array,
  userComments: Array,
  interests: Object,
})
const { isEligibleForInterest, interestApiCall, interestChanged, interestChangeHandler, interestChangeControllerCall, isFetching, isFinished, interestChangeFetching } = useYourInterest(props);
</script>
