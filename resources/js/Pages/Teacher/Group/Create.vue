<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    title: ''
});

</script>

<template>
    <Head>
        <title>Создание группы</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Создание группы</h1>
        </template>
        <div class="max-w-7xl mx-auto sm:px-2">
            <div class="m-6">
                <Link :href="route('teacher.groups.index')" class="mb-6 text-emerald-500 hover:text-gray-800">Назад</Link>
                <form @submit.prevent="form.post(route('teacher.groups.store'), { onSuccess: () => form.reset() })">
                    <div class="my-4">
                        <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow">Создать</button>
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
                </form>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
