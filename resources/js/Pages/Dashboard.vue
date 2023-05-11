<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;
defineProps(['userxamples']);
</script>

<template>
    <Head title="Кабинет" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Кабинет</h2>
        </template>

        <div class="my-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">{{user.name}} {{user.surname}}</div>
                </div>
            </div>
        </div>

        <div class="my-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="block font-medium text-slate-700 mb-4">Назначенные упражнения</h3>
                    <div  class="mb-4 hover:bg-slate-200 inline-block bg-slate-100 border rounded-lg flex justify-start items-center px-4 py-2"
                        v-for="(xample, index) in userxamples"
                        :key="index"
                    >
                        <Link :href="route('showxample', xample)">{{xample.title}}</Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
