<script setup>
import { onMounted, ref } from 'vue';

const show = ref(true);

const props = defineProps(['toast'])

onMounted(() => {
    let setting = localStorage.getItem(props.toast);
    if (setting === null) {
        localStorage.setItem(props.toast, "show");
    }
    if (setting == 'hidden') {
        show.value = false;
    }
});

function hideToast() {
    localStorage.setItem(props.toast, "hidden");
    show.value = false;
}

</script>

<template>
    <div v-if="show" class="flex items-start w-full p-6 text-white bg-emerald-500 sm:rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="text-sm font-normal pr-6">
            <slot />
            {{props.toast}}
        </div>
        <div class="flex items-center ml-auto space-x-2">
            <button @click="hideToast" type="button" class="bg-emerald-500 text-white hover:text-emerald-500 rounded-lg focus:ring-2 focus:ring-white p-1.5 hover:bg-white inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-undo" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    </div>
</template>