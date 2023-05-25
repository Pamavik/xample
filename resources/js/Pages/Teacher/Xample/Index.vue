<script setup>
import Sidebar from '@/Components/Sidebar.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from "@/Components/Pagination.vue";
import ModalDialog  from "@/Components/ModalDialog.vue";
import { Head, Link, router  } from '@inertiajs/vue3';
import { ref} from 'vue';
defineProps(['xamples']);

const displayModal = ref(false);
const delXample = ref(0);

function confirm() {
  displayModal.value = false;
  router.delete(route('teacher.xamples.destroy', delXample.value));
  delXample.value = 0;
};

function cancel() {
  displayModal.value = false;
};

const deleteXample = (xample) => {
    displayModal.value = true;
    delXample.value = xample;
};
//:href="route('teacher.xamples.destroy', xample.id)"  method="delete" as="button"
//@click="deleteXample(xample.id)"
</script>

<template>
    <Head>
        <title>Xamples</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Упражнения</h2>
        </template>
            <div class="max-w-7xl mx-auto sm:px-2">
                <div class="m-6">
                    <Link :href="route('teacher.xamples.create')" as="button" class="bg-emerald-500 hover:bg-emerald-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow">Создать упражнение</Link>
                </div>
                <div class="max-w-7xl px-6">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                        <p v-if="xamples.data == 0" class="mb-4">У вас ещё нет упражнений</p>
                        <div class="mr-4 mb-4 hover:bg-slate-200 inline-block bg-slate-100 border rounded-lg flex justify-between items-center px-4 py-2"
                            v-for="(xample, index) in xamples.data"
                            :key="xample.id"
                        >
                            <div class="grow">{{ index + 1 }}. {{ xample.title }}</div>
                            <Link :href="route('teacher.xamples.edit', xample.id)" class="block cursor-pointer text-emerald-400 hover:bg-slate-200 h-6 flex items-center mr-2">
                                <svg viewBox="0 0 20 20" class="h-6 w-6 fill-current"><path xmlns="http://www.w3.org/2000/svg" d="M13.8 2.2a2.51 2.51 0 0 0-3.54 0l-6.9 6.91-1.76 3.62a1.26 1.26 0 0 0 1.12 1.8 1.23 1.23 0 0 0 .55-.13l3.62-1.76 6-6 .83-.82.06-.06a2.52 2.52 0 0 0 .02-3.56zm-.89.89a1.25 1.25 0 0 1 0 1.77l-1.77-1.77a1.24 1.24 0 0 1 .86-.37 1.22 1.22 0 0 1 .91.37zM2.73 13.27 4.29 10 6 11.71zm4.16-2.4L5.13 9.11 10.26 4 12 5.74z"/></svg>
                            </Link>
                            <button @click="deleteXample(xample.id)" class="font-black block cursor-pointer text-emerald-400 hover:bg-slate-200 h-6 flex items-center">
                                X
                            </button>
                        </div>
                    </div>
                    <pagination class="mt-6" :links="xamples.links" />
                </div>
            </div>
        <ModalDialog v-if="displayModal" question="Вы действительно хотите удалить?" :onConfirm="confirm" :onCancel="cancel" />
    </AuthenticatedLayout>
</template>