<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import SimplePagination from '@/Components/SimplePagination.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps(['group', 'xamples', 'groupxamples']);

const form = useForm({
    title: props.group.title,
    selectedItems: props.groupxamples,
});

async function copyURL(url) {
    try {
      await navigator.clipboard.writeText(url);
      alert('Скопировано: '+ url);
    } catch($e) {
      alert('Ссылка не скопирована!');
    }
}
</script>

<template>
    <Head>
        <title>Редактировать группу</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Редактировать группу</h1>
        </template>
        <div class="max-w-7xl mx-auto sm:px-2">
            <div class="p-6">
                <Link :href="route('teacher.groups.index')" class="mb-6 text-emerald-500 hover:text-gray-800">Назад</Link>
                <div class="py-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 flex">
                            <p class="break-all">Ссылка на регистрацию учеников в группу: <strong>https://xample.ru/register/{{group.id}}</strong></p> 
                            <button @click="copyURL('https://xample.ru/register/'+group.id)" class="cursor-pointer text-emerald-500 h-6 flex items-center ml-2 hover:text-gray-800">
                                <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current"><path xmlns="http://www.w3.org/2000/svg" d="M16 12.9V17.1C16 20.6 14.6 22 11.1 22H6.9C3.4 22 2 20.6 2 17.1V12.9C2 9.4 3.4 8 6.9 8H11.1C14.6 8 16 9.4 16 12.9Z" /><path xmlns="http://www.w3.org/2000/svg" d="M17.0998 2H12.8998C9.81668 2 8.37074 3.09409 8.06951 5.73901C8.00649 6.29235 8.46476 6.75 9.02167 6.75H11.0998C15.2998 6.75 17.2498 8.7 17.2498 12.9V14.9781C17.2498 15.535 17.7074 15.9933 18.2608 15.9303C20.9057 15.629 21.9998 14.1831 21.9998 11.1V6.9C21.9998 3.4 20.5998 2 17.0998 2Z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <form @submit.prevent="form.put(route('teacher.groups.update', group.id), { onSuccess: () => editing = false })">
                    <div class="mb-4">
                        <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow">Сохранить</button>
                    </div>
                    <InputLabel for="title" value="Название группы" />

                    <TextInput
                        id="title"
                        type="text"
                        class="mt-1 block w-full mb-4 px-6 py-2 outline-none border-gray-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 rounded-md shadow-sm"
                        v-model="form.title"
                        required
                    />
                    <InputError :message="form.errors.title" class="mt-2 mb-4" />

                    <div class="w-full bg-white border rounded-lg pt-4">
                        <h3 class="block px-6 font-medium text-slate-700 mb-4">Назначенные упражнения</h3>
                        <div  class="mb-4 mx-6 hover:bg-slate-200 inline-block bg-slate-100 border rounded-lg flex justify-start items-center px-4 py-2"
                            v-for="(xample, index) in xamples.data"
                            :key="index"
                        >

                            <label class="flex items-center">
                                <Checkbox name="remember" :value="xample.id" v-model:checked="form.selectedItems" />
                                <span class="ml-2 text-sm text-slate-600">{{xample.title}}</span>
                            </label>
                        </div>
                        <SimplePagination :prev_page_url="xamples.prev_page_url" :next_page_url="xamples.next_page_url" />
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
