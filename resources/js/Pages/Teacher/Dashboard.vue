<script setup>
import Sidebar from '@/Components/Sidebar.vue';
import Toast from '@/Components/Toast.vue';
import Panel from '@/Components/Panel.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

defineProps({
    students: {},
    newstudents: {},
});

</script>

<template>
    <Head title="Кабинет" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Кабинет</h2>
        </template>

                <div class="py-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <Panel />
                    </div>
                </div>

                <div class="pb-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <p class="break-words">Ссылка на регистрацию ученика без группы: <strong>https://xample.ru/register/{{user.id}}</strong></p> 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-6" v-if="newstudents.length != 0">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg pb-3">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight p-6">Новые ученики</h3>
                            <div class="px-6 pb-3 text-gray-900" v-for="student in newstudents" 
                                :key="student.id">
                                    <Link :href="route('teacher.user', {'user_id': student.id})">Ученик: <strong>{{student.name}} {{student.surname}}</strong></Link>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg pb-3">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight p-6">Ученики</h3>
                            <div class="px-6 pb-3 text-gray-900" v-for="student in students" 
                                :key="student.id">
                                    Ученик: <strong>{{student.name}} {{student.surname}}</strong> Рейтинг: <strong>{{student.rating}}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-6">
                    <div class="container mx-auto sm:px-6 lg:px-8">
                        <Toast toast="toast1">
                            <p>Мы предоставляем инструменты, которые позволяют репетиторам создавать упражнения для изучения иностранных языков, которые могут быть использованы их учениками. Мы понимаем, что каждый ученик уникален и имеет свои индивидуальные потребности в изучении языков, поэтому мы даем возможность нашим репетиторам создавать упражнения, которые могут соответствовать их потребностям.</p>
                            <p>Наш сервис предлагает репетиторам различные инструменты, которые помогают создавать уникальные и интересные упражнения для изучения иностранных языков.</p>
                        </Toast>
                    </div>
                </div>
                



    </AuthenticatedLayout>
</template>
