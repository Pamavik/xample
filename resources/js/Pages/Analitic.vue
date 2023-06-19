<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';


defineProps({
    teachers: {
        type: Object,
    },
    students: {
        type: Object,
    },
    xamples: 0,
    
});
</script>

<template>
    <Head title="Аналитика" />

   

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <h2>Репетиторы:</h2>
            <div v-for="(teacher, index) in teachers" key="teacher.id">
                {{index+1}} {{teacher.full_name}} {{teacher.email}}
            </div>
        </div>
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <h2>Ученики:</h2>
            <div v-for="(student, index) in students" key="student.id">
                {{index+1}} {{student.full_name}} {{student.email}}
            </div>
        </div>
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <h2>Количество упражнений:</h2>
            <div>
                {{xamples}}
            </div>
        </div>

       

</template>