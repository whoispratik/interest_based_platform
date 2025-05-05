import { useForm } from "@inertiajs/vue3";
import { useFetch } from "@vueuse/core";
import { useUtilityStore }  from "@/Store/utility";
export function useCategoryApiDealing(props) {
    const utilityStore = useUtilityStore();
    const form=useForm({
        title: props?.title ?? '',
        description: props?.description ?? '',
        subreddit : '',
        category_one : '',
        category_two : '',
      })
    const { isFetching, isFinished, data, execute, onFetchError} = useFetch('http://127.0.0.1:9000/predict_category',{immediate: false}).post({
        title: form.title,
        description: form.description,
    }).json();
    onFetchError(ctx => {
        utilityStore.fetchError = true;
        console.log('error from category prediction api', ctx);
    })
    async function categoryApiCall(){
        try {
            await execute(true);
        }
        catch (error) {
            return Promise.reject(new Error('useFetch Error')) //since execute(true) after onFetchError completes the control of this function will pass to this catch block and then form.post/form.put does not get executed
        }
        form.category_one = data.value.category_1;
        form.category_two = data.value.category_2;
        form.subreddit = data.value.predicted_subreddit;
    }
      return { form, categoryApiCall, isFetching, isFinished};
}