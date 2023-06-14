<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from "@/Components/Pagination.vue";
import Toast from '@/Components/Toast.vue';
import ModalDialog  from "@/Components/ModalDialog.vue";
import Panel from '@/Components/Panel.vue';
import { Head, Link, router, useForm  } from '@inertiajs/vue3';
import { reactive} from 'vue';
defineProps(['results']);

const panel = reactive({
    visible: false,
    list: [],
    top: 0
});

function showUserResults(user_id) {
    router.get(route('results.index'),{ 'user_id': user_id});
}

function showXampleResults(xample_id) {
    router.get(route('results.index'),{ 'xample_id': xample_id});
}

function showErrors(errors_list, event){   
    panel.list = errors_list;
    panel.visible = true;
    panel.top = window.pageYOffset;
}
function close(){
    panel.visible = false;
}

</script>

<template>
    <Head>
        <title>Xamples</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Результаты</h1>
        </template>
            <div class="pt-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <Panel />
                    </div>
                </div>

            <div class="my-2">
                    <div class="container mx-auto sm:px-6 lg:px-8">
                        <Toast toast="results">
                            <p>Здесь можно посмотреть результаты индивидуально по упражнениям или ученикам.</p>
                        </Toast>
                    </div>
                </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6 relative">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                        <div v-if="results.data != 0"><Link :href="route('results.index')" class="mb-8 text-emerald-500 hover:text-gray-800">Показать все результаты</Link></div>
                        <p v-if="results.data == 0" class="mb-4">Ваши ученики ещё не выполнили ни одного задания</p>
                        <table v-else class="border-collapse border border-emerald-500 table-auto w-full">
                            <thead>
                                <tr>
                                <th class="border-collapse border border-emerald-500 text-left p-2 bg-emerald-500 text-white">Упражнение</th>
                                <th class="border-collapse border border-emerald-500 text-left p-2 bg-emerald-500 text-white">Ученик</th>
                                <th class="border-collapse border border-emerald-500 text-left p-2 bg-emerald-500 text-white">Ошибки</th>
                                <th class="border-collapse border border-emerald-500 text-left p-2 bg-emerald-500 text-white">Дата</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(result, index) in results.data"
                                    :key="result.id">
                                    <td class="border-collapse border border-emerald-500 p-2 hover:bg-gray-200 cursor-pointer" @click="showXampleResults(result.xample.id)">
                                        {{result.xample.title}}
                                    </td>
                                    <td class="border-collapse border border-emerald-500 p-2 hover:bg-gray-200 cursor-pointer" @click="showUserResults(result.user.id)">
                                        {{result.user.full_name}}
                                    </td>
                                    <td class="border-collapse border border-emerald-500 p-2 hover:bg-gray-200">
                                        <span v-if="result.errors_count == 0">Нет</span>
                                        <button v-else-if="result.errors_count == 1 " @click="showErrors(result.errors_list, $event)" class="block cursor-pointer text-emerald-500 h-6 hover:text-gray-800">
                                        {{result.errors_count}} ошибка
                                        </button>
                                        <button v-else-if="result.errors_count > 1 && result.errors_count < 5" @click="showErrors(result.errors_list, $event)" class="block cursor-pointer text-emerald-500 h-6 hover:text-gray-800">
                                        {{result.errors_count}} ошибки
                                        </button>
                                        <button v-else @click="showErrors(result.errors_list, $event)" class="block cursor-pointer text-emerald-500 h-6 hover:text-gray-800">
                                        {{result.errors_count}} ошибок
                                        </button>
                                    </td>
                                    <td class="border-collapse border border-emerald-500 p-2">
                                        {{result.created_at}}
                                    </td>

                                </tr>
                               
                            </tbody>
                        </table>

                        <div v-if="panel.visible" class="flex justify-between items-center absolute block left-8 rounded-lg right-8 z-[1000] mt-0 border-none bg-white bg-clip-padding shadow-lg shadow-black/5 p-6"
                            :style="{ top: panel.top + 'px' }">
                            <table class="border-collapse border border-emerald-500 table-auto w-full mt-4">
                                <thead>
                                    <tr>
                                    <th class="border-collapse border border-emerald-500 text-left p-2 bg-emerald-500 text-white">Вопрос</th>
                                    <th class="border-collapse border border-emerald-500 text-left p-2 bg-emerald-500 text-white">Ответ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in panel.list"
                                        :key="index">
                                        <td class="border-collapse border border-emerald-500 p-2">
                                            {{item.question}}
                                        </td>
                                        <td class="border-collapse border border-emerald-500 p-2">
                                            {{item.answer}}
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <div class="absolute right-0 top-0">
                                <button @click="close()" class="font-black block rounded-lg cursor-pointer text-emerald-500 hover:bg-emerald-500 hover:text-white h-6 flex items-center p-4">
                                    X
                                </button>
                            </div>
                            
                        </div>
                    </div>
                    <pagination class="mt-6" :links="results.links" />
            
            </div>
            <div v-if="panel.visible" class="fixed top-0 left-0 bottom-0 right-0 z-50 bg-gray-500 opacity-50"></div>
    </AuthenticatedLayout>
</template>