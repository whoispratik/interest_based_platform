<template>
    <div class="flex max-w-lg flex-col space-y-6 overflow-hidden rounded-lg p-6 shadow-2xl">
     <!-- Header: User info on the left, badges on the right -->
     <div class="flex justify-between items-center">
       <div>
         <a  href="#" class="text-base font-semibold"><slot name="user"></slot></a>
         <span class="block text-xs dark:text-gray-600"><slot name="timestamp"></slot></span>
       </div>
       <div class="flex space-x-2">
         <span class="rounded-full border border-emerald-900 px-2.5 py-0.5 text-sm  text-emerald-700 text-center">
           <slot name="category_one"></slot>
         </span>
         <span class="rounded-full border border-emerald-900 px-2.5 py-0.5 text-sm  text-emerald-700 text-center">
           <slot name="category_two">
           </slot>
         </span>
       </div>
     </div>
   
     <!-- Post Content -->
     <div>
      <Link :href="props.postRoute">
        <h2 class="mb-1 text-xl font-semibold"><slot name="title"></slot></h2>
        <p class="text-base dark:text-gray-600">
          <slot name="description"></slot>
        </p>
      </Link>
     </div>
   
     <!-- Footer: Comments and likes -->
     <div class="flex flex-wrap justify-between dark:text-gray-600">
       <div class="flex space-x-2 text-sm">
         <Link :href="props.postRoute" as="button" class="flex items-center space-x-1.5 p-1 group">
           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-label="Number of comments" 
           class="h-4 w-4 fill-current  group-hover:text-emerald-500  transition duration-300 ease-in-out transform group-active:scale-110"
           :class="[utilityStore.checkCommented(props.postComments) ? 'text-emerald-700' : 'text-gray-500']"
           >
             <path d="M448.205,392.507c30.519-27.2,47.8-63.455,47.8-101.078,0-39.984-18.718-77.378-52.707-105.3C410.218,158.963,366.432,144,320,144s-90.218,14.963-123.293,42.131C162.718,214.051,144,251.445,144,291.429s18.718,77.378,52.707,105.3c33.075,27.168,76.861,42.13,123.293,42.13,6.187,0,12.412-.273,18.585-.816l10.546,9.141A199.849,199.849,0,0,0,480,496h16V461.943l-4.686-4.685A199.17,199.17,0,0,1,448.205,392.507ZM370.089,423l-21.161-18.341-7.056.865A180.275,180.275,0,0,1,320,406.857c-79.4,0-144-51.781-144-115.428S240.6,176,320,176s144,51.781,144,115.429c0,31.71-15.82,61.314-44.546,83.358l-9.215,7.071,4.252,12.035a231.287,231.287,0,0,0,37.882,67.817A167.839,167.839,0,0,1,370.089,423Z"></path>
             <path d="M60.185,317.476a220.491,220.491,0,0,0,34.808-63.023l4.22-11.975-9.207-7.066C62.918,214.626,48,186.728,48,156.857,48,96.833,109.009,48,184,48c55.168,0,102.767,26.43,124.077,64.3,3.957-.192,7.931-.3,11.923-.3q12.027,0,23.834,1.167c-8.235-21.335-22.537-40.811-42.2-56.961C270.072,30.279,228.3,16,184,16S97.928,30.279,66.364,56.206C33.886,82.885,16,118.63,16,156.857c0,35.8,16.352,70.295,45.25,96.243a188.4,188.4,0,0,1-40.563,60.729L16,318.515V352H32a190.643,190.643,0,0,0,85.231-20.125,157.3,157.3,0,0,1-5.071-33.645A158.729,158.729,0,0,1,60.185,317.476Z"></path>
           </svg>
           <span><slot name="commentsCount"></slot></span>
         </Link>
         <button @click.stop="makeRequest" class="flex items-center space-x-1.5 p-1 group">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-label="Number of likes" 
    class="h-4 w-4 fill-current group-hover:text-emerald-500  transition duration-300 ease-in-out transform group-active:scale-110"
    :class="[utilityStore.checkLiked(props.postLikes) ? 'text-emerald-700' : ' text-gray-500']"
    >
    <path d="M126.638,202.672H51.986a24.692,24.692,0,0,0-24.242,19.434,487.088,487.088,0,0,0-1.466,206.535l1.5,7.189a24.94,24.94,0,0,0,24.318,19.78h74.547a24.866,24.866,0,0,0,24.837-24.838V227.509A24.865,24.865,0,0,0,126.638,202.672ZM119.475,423.61H57.916l-.309-1.487a455.085,455.085,0,0,1,.158-187.451h61.71Z"></path>
    <path d="M494.459,277.284l-22.09-58.906a24.315,24.315,0,0,0-22.662-15.706H332V173.137l9.573-21.2A88.117,88.117,0,0,0,296.772,35.025a24.3,24.3,0,0,0-31.767,12.1L184.693,222.937V248h23.731L290.7,67.882a56.141,56.141,0,0,1,21.711,70.885l-10.991,24.341L300,169.692v48.98l16,16H444.3L464,287.2v9.272L396.012,415.962H271.07l-86.377-50.67v37.1L256.7,444.633a24.222,24.222,0,0,0,12.25,3.329h131.6a24.246,24.246,0,0,0,21.035-12.234L492.835,310.5A24.26,24.26,0,0,0,496,298.531V285.783A24.144,24.144,0,0,0,494.459,277.284Z"></path>
  </svg>
  <span><slot name="likesCount"></slot></span>
         </button>

       </div>
     </div>
   </div>
   </template>
   <script setup>
  import { Link, router } from '@inertiajs/vue3';
  import { computed, defineProps } from 'vue';
  import { useUtilityStore } from '@/Store/utility';
  const props = defineProps({
    postRoute: String,
    postLikes: Array,
    postComments: Array,
    addLikeRoute: String,
  })
  const utilityStore = useUtilityStore();
  const currentMethod = computed(() => {
    return utilityStore.checkLiked(props.postLikes) ? 'delete' : 'post';
  });
  const currentRoute = computed(() => {
    return utilityStore.checkLiked(props.postLikes)
      ? props.addLikeRoute + `/${utilityStore.checkLiked(props.postLikes).id}`
      : props.addLikeRoute;
  });
  function makeRequest() {
    router.visit(currentRoute.value, {
      method: currentMethod.value,
      preserveScroll: true
    })
  }
</script>