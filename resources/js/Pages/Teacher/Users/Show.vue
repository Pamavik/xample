<script setup>
import Sidebar from '@/Components/Sidebar.vue';
import Checkbox from '@/Components/Checkbox.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps(['user','xamples', 'userxamples']);

const form = useForm({
    user: props.user,
    selectedItems: props.userxamples,
});


</script>

<template>
    <Head title="Ученик" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ученик</h2>
        </template>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="w-full bg-white border rounded-lg px-4 py-4 my-4">
                    {{user.name}}
                </div>
                <form @submit.prevent="form.put(route('teacher.updateuser'), { onSuccess: () => form.reset() })">
                    <h3 class="block font-medium text-slate-700">Назначенные упражнения</h3>
                    <div class="w-full bg-white border rounded-lg px-4 pt-4 my-4">
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
                    <div class="mb-4">
                        <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow">Сохранить</button>
                    </div>
                </form>    
            </div>


    </AuthenticatedLayout>
</template>
