<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
const props = defineProps(['description']);
</script>
<template>
    <div class="relative">
        <div v-if="props.description" class="w-full bg-white border rounded-lg p-4 my-4" v-html="props.description">
        </div>
        <div>
            <PrimaryButton @click="$emit('startXample')">Начать</PrimaryButton>
        </div>
    </div>
</template>