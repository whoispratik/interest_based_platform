<template>
   <div class=" rounded-lg shadow-lg overflow-hidden mt-3">
    <input type="checkbox" :id="id" class="peer hidden" />
    <label :for="id"
           class="flex items-center justify-between p-4 bg-violet-800  cursor-pointer hover:bg-violet-900 transition-colors">
      <span class="text-lg font-semibold">{{ category }}</span>
      <svg class="w-6 h-6 transition-transform peer-checked:rotate-180"
           fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 9l-7 7-7-7"/>
      </svg>
    </label>
    <div class="max-h-0 overflow-hidden transition-all duration-300 peer-checked:max-h-screen">
      <div class="p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <!-- Dummy show options -->
        <label class="flex items-center space-x-2" v-for="(item) in interestState" :key="item.name">
          <input type="checkbox" class="form-checkbox h-5 w-5 text-emerald-600" v-model="item.isChecked"/>
          <span>{{ item.name }}</span>
        </label>
        
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, nextTick, onBeforeUpdate, onUpdated } from 'vue'
const emit = defineEmits(['interestChange'])
const props = defineProps({
  id:       { type: String, required: true },
  interest: { type: Array,  required: true },
  category: { type: String, required: true }
})

const interestState = ref([])
const isResetting   = ref(false)

// 1) WATCH PROP → rebuild internal list
// it will run immediately in your creation/mounting phase once and then after everytime the props.interest changes
watch(
  () => props.interest,
  (newInterest) => {
    isResetting.value = true              // ⏸️ pause emits
    interestState.value = newInterest.map(name => ({
      name,
      isChecked: true
    }))
    // nextTick to ensure that the deep watcher sees this as “during reset”
    nextTick(() => {
      isResetting.value = false           // ▶️ resume emits
    })
  },
  { immediate: true }
)

// 2) WATCH INTERNAL STATE → emit only when NOT resetting
watch(
  interestState,
  (newList) => {
    if (isResetting.value) return         // skip prop‐driven resets

    // collect checked names
    const checked = newList
      .filter(i => i.isChecked)
      .map(i => i.name)

    emit('interestChange', { [props.category]: checked })
  },
  { deep: true }
)
</script>

