<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed, defineEmits, onMounted, onUnmounted } from 'vue';
const props = defineProps(['type', 'text']);
const emit = defineEmits(['nextQuestion'])

let  timer;
onMounted(() => {
    if(props.type == 'emerald') {
      timer = setTimeout(function(){
        emit('nextQuestion');
      }, 1000);
    }
});
onUnmounted(() => clearInterval(timer));
</script>
<template>
    <div class="relative">
        <div :class="'bg-'+type+'-800'" class="w-full text-white border rounded-lg p-4 my-4">
            {{ props.text }}
        </div>
        <div>
            <PrimaryButton @click="$emit('nextQuestion')">Дальше</PrimaryButton>
        </div>
    </div>
</template>