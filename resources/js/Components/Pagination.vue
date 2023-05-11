<script setup>
import { Link } from '@inertiajs/vue3';
import {ref, onMounted } from 'vue'
const props = defineProps(['links']);

onMounted(() => {
 props.links[0].label = "<";
 props.links[props.links.length-1].label = ">";
})

</script>
<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, key) in props.links">
                <div
                    v-if="link.url === null"
                    :key="key"
                    class="
                        px-4
                        py-3
                        mb-1
                        mr-1
                        text-sm
                        leading-4
                        text-slate-400
                        border
                        rounded
                    "
                    v-html="link.label"
                />
                <Link
                    v-else
                    class="
                        px-4
                        py-3
                        mb-1
                        mr-1
                        text-sm
                        leading-4
                        border
                        rounded
                        hover:bg-white
                        focus:border-emerald-500 focus:text-emerald-500
                    "
                    :class="{ 'bg-emerald': link.active }"
                    :href="link.url"
                    v-html="link.label"
                />
            </template>
        </div>
    </div>
</template>