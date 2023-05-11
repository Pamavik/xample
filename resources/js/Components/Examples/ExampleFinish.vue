<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
const props = defineProps(['stats']);
</script>
<template>
    <div class="relative">
        <div class="w-full bg-white border rounded-lg p-4 my-4">
            <h3 class="font-semibold">Тест пройден</h3>
            <p>Количество правильных ответов: {{props.stats.success}}</p>
            <p>Количество ошибок: {{props.stats.error}}</p>
        </div>
        <div>
            <PrimaryButton @click="$emit('endXample')">Завершить</PrimaryButton>
        </div>
    </div>
</template>