<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="columns-3">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="px-2 py-6 text-emerald-500 text-center">
                <Link :href="route('teacher.xamples.index')">Упражнения</Link>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="px-2 py-6 text-emerald-500 text-center">
                <Link :href="route('teacher.groups.index')">Группы</Link>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="px-2 py-6 text-emerald-500 text-center">
                <Link :href="route('teacher.users')">Ученики</Link>
            </div>
        </div>
    </div>
</template>
