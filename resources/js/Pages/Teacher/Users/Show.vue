<script setup>
import SimplePagination from '@/Components/SimplePagination.vue';
import Checkbox from '@/Components/Checkbox.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps(['user','xamples', 'groups', 'userxamples', 'group']);

const form = useForm({
    user: props.user,
    selectedItems: props.userxamples,
});

const group_form = useForm({
    id: props.user.id,
    group_id: props.user.group_id
});


</script>

<template>
    <Head title="Ученик" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Ученик</h1>
        </template>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
            <Link :href="route('teacher.users')" class="mb-6 text-emerald-500 hover:text-gray-800">Назад</Link>
                <div class="w-full bg-white border rounded-lg px-6 py-4 my-4">
                    <p>{{user.name}} {{user.surname}}</p>
                    <p>Группа: {{group}}</p>
                </div>
                <form @submit.prevent="group_form.put(route('teacher.updateusergroup'), { onSuccess: () => group_form.reset() })">
                    
                    <div class="w-full bg-white border rounded-lg pt-4 my-4">
                        <h3 class="block font-medium text-slate-700 px-6 mb-4">Установленная группа</h3>
                        <div v-if="groups.current_page == 1" class="mb-4 mx-6 hover:bg-slate-200 inline-block bg-slate-100 border rounded-lg flex justify-start items-center px-4 py-2">
                            <label class="flex items-center">
                                <input type="radio" v-model="group_form.group_id" value="" class="outline-none active:outline-none active:bg-emerald-600 hover:bg-emerald-600 focus:outline-none focus:ring focus:bg-emerald-600 focus-within:bg-emerald-600 focus-visible:bg-emerald-600 checked:bg-emerald-600"/>
                                <span class="ml-2 text-sm text-slate-600">Без группы</span>
                            </label>
                        </div>
                        <div class="mb-4 mx-6 hover:bg-slate-200 inline-block bg-slate-100 border rounded-lg flex justify-start items-center px-4 py-2"
                            v-for="(group, index) in groups.data"
                            :key="group.id"
                        >

                            <label class="flex items-center">
                                <input type="radio" v-model="group_form.group_id" :value="group.id" class="outline-none active:outline-none active:bg-emerald-600 hover:bg-emerald-600 focus:outline-none focus:ring focus:bg-emerald-600 focus-within:bg-emerald-600 focus-visible:bg-emerald-600 checked:bg-emerald-600"/>
                                <span class="ml-2 text-sm text-slate-600">{{group.title}}</span>
                            </label>
                        </div>
                        <SimplePagination :prev_page_url="groups.prev_page_url" :next_page_url="groups.next_page_url" />
                        <div class="mb-4 mx-6">
                            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow">Сохранить</button>
                        </div>
                    </div>
                    
                </form>    
                <form @submit.prevent="form.put(route('teacher.updateuser'), { onSuccess: () => form.reset() })">
                    
                    <div class="w-full bg-white border rounded-lg pt-4 my-4">
                        <h3 class="block font-medium text-slate-700 px-6 mb-4">Назначенные упражнения</h3>
                        <div  class="mb-4 mx-6 hover:bg-slate-200 inline-block bg-slate-100 border rounded-lg flex justify-start items-center px-4 py-2"
                            v-for="(xample, index) in xamples.data"
                            :key="xample.id"
                        >

                            <label class="flex items-center">
                                <Checkbox name="remember" :value="xample.id" v-model:checked="form.selectedItems" />
                                <span class="ml-2 text-sm text-slate-600">{{xample.title}}</span>
                            </label>
                        </div>
                        <SimplePagination :prev_page_url="xamples.prev_page_url" :next_page_url="xamples.next_page_url" />
                        <div class="mb-4 px-6">
                            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow">Сохранить</button>
                        </div>
                    </div>
                    
                </form>    
            </div>


    </AuthenticatedLayout>
</template>
