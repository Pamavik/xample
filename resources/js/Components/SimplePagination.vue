<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps(['prev_page_url', 'next_page_url']);

</script>
<template>
    <div class="px-6 pb-6 text-gray-900">
        <Link v-if="props.prev_page_url" 
            
            class="border border-gray-300 text-gray-300 hover:text-emerald-300 rounded-lg px-3 py-1 mb-3 mr-3 bg-white hover:border-emerald-300" 
            :href="props.prev_page_url" 
            preserve-state preserve-scroll>
                &lt;
        </Link>
        <Link v-if="props.next_page_url" 
            
            class="border border-gray-300 text-gray-300 hover:text-emerald-300 rounded-lg px-3 py-1 mb-3 mr-3 bg-white hover:border-emerald-300" 
            :href="props.next_page_url" 
            preserve-state preserve-scroll>
                &gt;
        </Link>
    </div>
</template>