<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps(['group', 'xamples', 'groupxamples']);

const form = useForm({
    title: props.group.title,
    selectedItems: props.groupxamples,
});
</script>

<template>
    <Head>
        <title>Редактировать группу</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Редактировать группу</h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-2">
            <div class="m-6">
                <!-- Page Heading -->
                <h1 class="text-2xl font-semibold mb-4">Редактрование упражнения</h1>
                <div class="pb-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <p class="break-words">Ссылка на регистрацию учеников в группу: <strong>https://xample.ru/register/{{group.id}}</strong></p> 
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
                        class="mt-1 block w-full mb-4 p-2 outline-none border-gray-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 rounded-md shadow-sm"
                        v-model="form.title"
                        required
                    />
                    <InputError :message="form.errors.title" class="mt-2 mb-4" />

                    <div class="w-full bg-white border rounded-lg px-4 pt-4 my-4">
                        <h3 class="block font-medium text-slate-700 mb-4">Назначенные упражнения</h3>
                        <div  class="mb-4 hover:bg-slate-200 inline-block bg-slate-100 border rounded-lg flex justify-start items-center px-4 py-2"
                            v-for="(xample, index) in xamples"
                            :key="index"
                        >

                            <label class="flex items-center">
                                <Checkbox name="remember" :value="xample.id" v-model:checked="form.selectedItems" />
                                <span class="ml-2 text-sm text-slate-600">{{xample.title}}</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
