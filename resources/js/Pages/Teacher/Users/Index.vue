<script setup>
import Sidebar from '@/Components/Sidebar.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

defineProps({
    users: {},
});

</script>

<template>
    <Head title="Ученики" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ученики</h2>
        </template>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full bg-white border rounded-lg px-4 pt-4 my-4">
                    <div  class="mb-4 hover:bg-slate-200 inline-block bg-slate-100 border rounded-lg flex justify-between items-center px-4 py-2"
                        v-for="(user, index) in users"
                        :key="index"
                    >
                    <p class="grow">{{ index+1 }}. {{user.name}} {{user.surname}}</p> 
                    <Link :href="route('teacher.user', {'user_id': user.id})" class="block cursor-pointer text-emerald-400 hover:bg-slate-200 h-6 flex items-center ml-2">
                            <svg viewBox="0 0 20 20" class="h-6 w-6 fill-current"><path d="M17.283,5.549h-5.26V4.335c0-0.222-0.183-0.404-0.404-0.404H8.381c-0.222,0-0.404,0.182-0.404,0.404v1.214h-5.26c-0.223,0-0.405,0.182-0.405,0.405v9.71c0,0.223,0.182,0.405,0.405,0.405h14.566c0.223,0,0.404-0.183,0.404-0.405v-9.71C17.688,5.731,17.506,5.549,17.283,5.549 M8.786,4.74h2.428v0.809H8.786V4.74z M16.879,15.26H3.122v-4.046h5.665v1.201c0,0.223,0.182,0.404,0.405,0.404h1.618c0.222,0,0.405-0.182,0.405-0.404v-1.201h5.665V15.26z M9.595,9.583h0.81v2.428h-0.81V9.583zM16.879,10.405h-5.665V9.19c0-0.222-0.183-0.405-0.405-0.405H9.191c-0.223,0-0.405,0.183-0.405,0.405v1.215H3.122V6.358h13.757V10.405z"></path></svg>
                        </Link>
                        <Link :href="route('teacher.dashboard')" class="block cursor-pointer text-emerald-400 hover:bg-slate-200 h-6 flex items-center ml-2">
                            <svg viewBox="0 0 20 20" class="h-6 w-6 fill-current"><path d="M15.396,2.292H4.604c-0.212,0-0.385,0.174-0.385,0.386v14.646c0,0.212,0.173,0.385,0.385,0.385h10.792c0.211,0,0.385-0.173,0.385-0.385V2.677C15.781,2.465,15.607,2.292,15.396,2.292 M15.01,16.938H4.99v-2.698h1.609c0.156,0.449,0.586,0.771,1.089,0.771c0.638,0,1.156-0.519,1.156-1.156s-0.519-1.156-1.156-1.156c-0.503,0-0.933,0.321-1.089,0.771H4.99v-3.083h1.609c0.156,0.449,0.586,0.771,1.089,0.771c0.638,0,1.156-0.518,1.156-1.156c0-0.638-0.519-1.156-1.156-1.156c-0.503,0-0.933,0.322-1.089,0.771H4.99V6.531h1.609C6.755,6.98,7.185,7.302,7.688,7.302c0.638,0,1.156-0.519,1.156-1.156c0-0.638-0.519-1.156-1.156-1.156c-0.503,0-0.933,0.322-1.089,0.771H4.99V3.062h10.02V16.938z M7.302,13.854c0-0.212,0.173-0.386,0.385-0.386s0.385,0.174,0.385,0.386s-0.173,0.385-0.385,0.385S7.302,14.066,7.302,13.854 M7.302,10c0-0.212,0.173-0.385,0.385-0.385S8.073,9.788,8.073,10s-0.173,0.385-0.385,0.385S7.302,10.212,7.302,10 M7.302,6.146c0-0.212,0.173-0.386,0.385-0.386s0.385,0.174,0.385,0.386S7.899,6.531,7.688,6.531S7.302,6.358,7.302,6.146"></path></svg>
                        </Link>
                    </div>
                </div>
    </div>  

    </AuthenticatedLayout>
</template>
