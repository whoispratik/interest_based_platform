import { ref, computed, watch } from "vue";
import { useFetch } from "@vueuse/core";
import { router } from "@inertiajs/vue3";
import { isEqual } from "lodash";
import { removeEmptyArrays } from "@/utils/InterestUtils";
import { useUtilityStore } from "@/Store/utility";
export function useYourInterest(props) {
    // Define a ref to hold the user data
    const userPosts = ref(props.userPosts);
    const userComments = ref(props.userComments);
    const userLikes = ref(props.userLikes);
    const { isFetching, isFinished, data, execute, onFetchError } = useFetch(
        "http://127.0.0.1:9000/interest_prediction",
        { immediate: false }
    )
        .post({
            posts: props.userPosts,
            likes: props.userLikes,
            comments: props.userComments,
        })
        .json();
    const changedInterestState = ref(
        JSON.parse(JSON.stringify(props.interests))
    ); // first time initialization when the component instance is created
    const interestChanged = ref(false);
    const interestChangeFetching = ref(false);
    const utilityStore = useUtilityStore();
    // Computed property to check if the user is eligible for interest
    const isEligibleForInterest = computed(() => {
        return (userPosts.value.length ?? 0) +
            (userComments.value.length ?? 0) +
            (userLikes.value.length ?? 0) >=
            1
            ? true
            : false;
    });

    onFetchError((ctx) => {
        utilityStore.fetchError = true;
    });

    async function interestApiCall() {
        try {
            utilityStore.fetchError = false;
            await execute(true);
        } catch (error) {
            return; // since execute(true) after onFetchError completes the control of this function will pass to this catch block and then router.put does not get executed
        }
        router.put("/user/interests", data.value, {
            onSuccess: () => {
                interestChanged.value = false;
            },
        });
    }

    function interestChangeHandler(newValue) {
        // grab the one-and-only key from newValue
        const key = Object.keys(newValue)[0];
        const newArr = newValue[key];
        // replace the array on the reactive state
        changedInterestState.value[key] = newArr;
        if (isEqual(changedInterestState.value, props.interests)) {
            interestChanged.value = false;
            return;
        }
        interestChanged.value = true;
    }

    function interestChangeControllerCall() {
        const data = removeEmptyArrays({ ...changedInterestState.value });
        router.put("/user/interests", data, {
            onSuccess: () => {
                interestChangeFetching.value = false;
                interestChanged.value = false;
            },
            onError: () => {
                utilityStore.fetchError = true;
                interestChangeFetching = false;
                interestChanged.value = true;
            },
            onProgress: () => {
                interestChangeFetching.value = true;
            },
        });
    }

    // when the props.interests are updated from the laravel controller
    watch(
        () => props.interests,
        (newValue) => {
            changedInterestState.value = JSON.parse(JSON.stringify(newValue));
        }
    );

    return {
        isEligibleForInterest,
        interestApiCall,
        interestChanged,
        interestChangeHandler,
        interestChangeControllerCall,
        isFetching,
        isFinished,
        interestChangeFetching,
    };
}
