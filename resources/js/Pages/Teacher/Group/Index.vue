<script setup>
import Sidebar from '@/Components/Sidebar.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from "@/Components/Pagination.vue";
import ModalDialog  from "@/Components/ModalDialog.vue";
import Panel from '@/Components/Panel.vue';
import { Head, Link, router  } from '@inertiajs/vue3';
import { ref} from 'vue';
defineProps(['groups']);

const displayModal = ref(false);
const delGroup = ref(0);

function confirm() {
  displayModal.value = false;
  router.delete(route('teacher.groups.destroy', delGroup.value));
  delGroup.value = 0;
};

function cancel() {
  displayModal.value = false;
};

const deleteGroup = (group) => {
    displayModal.value = true;
    delGroup.value = group;
};

</script>

<template>
    <Head>
        <title>Группы</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Группы</h1>
        </template>
            <div class="pt-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <Panel />
                    </div>
                </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6">
                    <Link :href="route('teacher.groups.create')" as="button" class="bg-emerald-500 hover:bg-emerald-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow">Создать группу</Link>
                </div>
                <div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                        <p v-if="groups.data == 0" class="mb-4">У вас ещё нет групп</p>
                        <div v-else class="mr-4 mb-4 hover:bg-slate-200 inline-block bg-slate-100 border rounded-lg flex justify-between items-center px-4 py-2"
                            v-for="(group, index) in groups.data"
                            :key="group.id"
                        >
                            <div class="grow">{{ index + groups.from }}. {{ group.title }}</div>
                            <Link :href="route('teacher.groups.edit', group.id)" class="block cursor-pointer text-emerald-400 hover:bg-slate-200 h-6 flex items-center mr-2">
                                <svg viewBox="0 0 20 20" class="h-6 w-6 fill-current"><path xmlns="http://www.w3.org/2000/svg" d="M13.8 2.2a2.51 2.51 0 0 0-3.54 0l-6.9 6.91-1.76 3.62a1.26 1.26 0 0 0 1.12 1.8 1.23 1.23 0 0 0 .55-.13l3.62-1.76 6-6 .83-.82.06-.06a2.52 2.52 0 0 0 .02-3.56zm-.89.89a1.25 1.25 0 0 1 0 1.77l-1.77-1.77a1.24 1.24 0 0 1 .86-.37 1.22 1.22 0 0 1 .91.37zM2.73 13.27 4.29 10 6 11.71zm4.16-2.4L5.13 9.11 10.26 4 12 5.74z"/></svg>
                            </Link>
                            <button @click="deleteGroup(group.id)" class="font-black block cursor-pointer text-emerald-400 hover:bg-slate-200 h-6 flex items-center">
                                X
                            </button>
                        </div>
                        <pagination class="mt-6" :links="groups.links" />
                    </div>
                    
                </div>
                
            </div>
            
        <ModalDialog v-if="displayModal" question="Вы действительно хотите удалить?" :onConfirm="confirm" :onCancel="cancel" />
    </AuthenticatedLayout>
</template>