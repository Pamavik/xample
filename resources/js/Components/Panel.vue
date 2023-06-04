<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="columns-2 md:columns-4">

        <Link class="block bg-white overflow-hidden shadow-sm hover:shadow-lg sm:rounded-lg px-2 py-6 text-emerald-500 text-center hover:bg-emerald-500 hover:text-white mb-4"
            :href="route('teacher.xamples.index')">
            Упражнения
        </Link>

        <Link class="block bg-white overflow-hidden shadow-sm hover:shadow-lg sm:rounded-lg px-2 py-6 text-emerald-500 text-center hover:bg-emerald-500 hover:text-white mb-4"
            :href="route('teacher.groups.index')">
            Группы
        </Link>
        
        <Link class="block bg-white overflow-hidden shadow-sm hover:shadow-lg sm:rounded-lg px-2 py-6 text-emerald-500 text-center hover:bg-emerald-500 hover:text-white mb-4"
            :href="route('teacher.users')">
            Ученики
        </Link>

        <Link class="block bg-white overflow-hidden shadow-sm hover:shadow-lg sm:rounded-lg px-2 py-6 text-emerald-500 text-center hover:bg-emerald-500 hover:text-white mb-4"
            :href="route('results.index')">
            Результаты
        </Link>

    </div>
</template>
