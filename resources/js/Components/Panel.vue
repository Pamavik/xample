<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="columns-2 md:columns-4">

        <Link class="flex flex-col items-center bg-white overflow-hidden shadow-sm hover:shadow-lg sm:rounded-lg px-2 py-6 text-emerald-500 text-center hover:bg-emerald-500 hover:text-white mb-4"
            :href="route('teacher.xamples.index')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 stroke-current" viewBox="0 0 200 160" fill="none">
            <rect x="2.5" y="2.5" width="195" height="155" rx="17.5" stroke-width="5"/>
            <rect x="27.5" y="27.5" width="106" height="15" rx="7.5" stroke-width="5"/>
            <rect x="27.5" y="57.5" width="145" height="15" rx="7.5" stroke-width="5"/>
            <rect x="27.5" y="87.5" width="35" height="15" rx="7.5" stroke-width="5"/>
            <rect x="27.5" y="117.5" width="45" height="15" rx="7.5" stroke-width="5"/>
            <rect x="77.5" y="87.5" width="35" height="15" rx="7.5" stroke-width="5"/>
            <rect x="127.5" y="87.5" width="35" height="15" rx="7.5" stroke-width="5"/>
            </svg>
            <span>Упражнения</span>
        </Link>

        <Link class="flex flex-col items-center bg-white overflow-hidden shadow-sm hover:shadow-lg sm:rounded-lg px-2 py-6 text-emerald-500 text-center hover:bg-emerald-500 hover:text-white mb-4"
            :href="route('teacher.groups.index')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 stroke-current" viewBox="0 0 200 160" fill="none">
            <rect x="2.5" y="2.5" width="195" height="155" rx="17.5" stroke-width="5"/>
            <circle cx="100" cy="55" r="27.5" stroke-width="5"/>
            <path d="M61.5 57.5C61.5 68.0492 53.1621 76.5 43 76.5C32.8379 76.5 24.5 68.0492 24.5 57.5C24.5 46.9508 32.8379 38.5 43 38.5C53.1621 38.5 61.5 46.9508 61.5 57.5Z" stroke-width="5"/>
            <path d="M138.5 57.5C138.5 68.0492 146.838 76.5 157 76.5C167.162 76.5 175.5 68.0492 175.5 57.5C175.5 46.9508 167.162 38.5 157 38.5C146.838 38.5 138.5 46.9508 138.5 57.5Z" stroke-width="5"/>
            <path d="M91 92.5H109C135.234 92.5 156.5 113.766 156.5 140V157.5H43.5V140C43.5 113.766 64.7665 92.5 91 92.5Z" stroke-width="5"/>
            <path d="M2.5 129.5C2.49994 105.5 9.18369 84 41.7418 84C57.4957 84 66.598 86.1395 75.0001 97.1938" stroke-width="5"/>
            <path d="M197.5 129.5C197.5 105.5 190.816 84 158.258 84C142.504 84 133.402 86.1395 125 97.1938" stroke-width="5"/>
            </svg>
            <span>Группы</span>
        </Link>
        
        <Link class="flex flex-col items-center bg-white overflow-hidden shadow-sm hover:shadow-lg sm:rounded-lg px-2 py-6 text-emerald-500 text-center hover:bg-emerald-500 hover:text-white mb-4"
            :href="route('teacher.users')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 stroke-current" viewBox="0 0 200 160" fill="none">
            <rect x="2.5" y="2.5" width="195" height="155" rx="17.5" stroke-width="5"/>
            <circle cx="100" cy="55" r="27.5" stroke-width="5"/>
            <path d="M91 92.5H109C135.234 92.5 156.5 113.766 156.5 140V157.5H43.5V140C43.5 113.766 64.7665 92.5 91 92.5Z" stroke-width="5"/>
            </svg>
            <span>Ученики</span>
        </Link>

        <Link class="flex flex-col items-center bg-white overflow-hidden shadow-sm hover:shadow-lg sm:rounded-lg px-2 py-6 text-emerald-500 text-center hover:bg-emerald-500 hover:text-white mb-4"
            :href="route('results.index')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 stroke-current" viewBox="0 0 200 160" fill="none">
            <rect x="2.5" y="2.5" width="195" height="155" rx="17.5" stroke-width="5"/>
            <rect x="27.5" y="27.5" width="145" height="15" rx="7.5" stroke-width="5"/>
            <rect x="27.5" y="57.5" width="145" height="15" rx="7.5" stroke-width="5"/>
            <rect x="27.5" y="87.5" width="145" height="15" rx="7.5" stroke-width="5"/>
            <rect x="27.5" y="117.5" width="145" height="15" rx="7.5" stroke-width="5"/>
            </svg>   
            <span>Результаты</span>
        </Link>

    </div>
</template>
