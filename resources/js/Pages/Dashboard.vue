<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SimplePagination from '@/Components/SimplePagination.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;
defineProps(['userxamples', 'group']);
</script>

<template>
    <Head title="Кабинет" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Кабинет</h2>
        </template>

        <div class="my-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                    <div><strong>{{user.name}} {{user.surname}}</strong></div>
                    <div>Рейтинг: <strong>{{user.rating}}</strong></div>
                    <div v-if="group">Группа: <strong>{{group.title}}</strong></div>
                </div>
            </div>
        </div>
        <div class="my-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h3 class="block m-6 font-medium text-slate-700 mb-4">Назначенные упражнения</h3>
                    <div  class="mb-4 mx-6 hover:bg-slate-200 inline-block bg-slate-100 border rounded-lg flex justify-start items-center px-4 py-2"
                        v-for="(xample, index) in userxamples.data"
                        :key="index"
                    >
                        <Link :href="route('showxample', xample)">{{xample.title}}</Link>
                    </div>
                    <SimplePagination :prev_page_url="userxamples.prev_page_url" :next_page_url="userxamples.next_page_url" />
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
