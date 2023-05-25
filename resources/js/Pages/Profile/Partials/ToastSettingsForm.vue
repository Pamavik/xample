<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { onMounted, ref } from 'vue';

const show = ref(true);
const hidden = ref(false);

onMounted(() => {
    let setting = localStorage.getItem('showToasts');
    if (setting === null) {
        localStorage.setItem('showToasts', "show");
    }
    if (setting == 'hidden') {
        show.value = false;
    }
    for(let i = 0; i < localStorage.length; i++) {
        let key = localStorage.key(i);
        if (localStorage.getItem(key) == 'hidden') {
            hidden.value = true;
        }
    }
});

function hideToasts() {
    show.value = false;
    for(let i = 0; i < localStorage.length; i++) {
        let key = localStorage.key(i);
        if (localStorage.getItem(key) == 'show') {
            localStorage.setItem(key, 'hidden')
        }
    }
}

function showToasts() {
    show.value = true;
    for(let i = 0; i < localStorage.length; i++) {
        let key = localStorage.key(i);
        if (localStorage.getItem(key) == 'hidden') {
            localStorage.setItem(key, 'show')
        }
    }
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Подсказки</h2>
            <p v-if="!show" class="mt-1 text-sm text-gray-600">
                Подсказки не показываются.
            </p>
            <p v-if="show" class="mt-1 text-sm text-gray-600">
                Подсказки показываются.
            </p>
        </header>

        <div class="block mt-4">
            <PrimaryButton @click="hideToasts" v-if="show">Спрятать подсказки</PrimaryButton>
            <PrimaryButton @click="showToasts" v-if="!show">Показывать подсказки</PrimaryButton>
            <PrimaryButton class="ml-4" @click="showToasts" v-if="hidden && show">Восстановить подсказки</PrimaryButton>
        </div>
    </section>
</template>
