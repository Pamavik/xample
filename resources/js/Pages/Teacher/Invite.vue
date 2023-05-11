<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    user: {},
});

</script>

<template>
    <Head title="Welcome" />

    

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex">
                <svg
                    viewBox="0 0 90 91"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-16 w-auto stroke-emerald-500"
                >
                        <path xmlns="http://www.w3.org/2000/svg" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M37.8874 8.90536L37.8182 8.5848L37.4967 8.52049L2.14132 1.44942L1.41493 1.30414L1.55189 2.03215L8.2694 37.741L8.33154 38.0714L8.66089 38.1385L43.4791 45.2374L9.37545 51.6529L9.04512 51.715L8.97797 52.0444L1.55335 88.4604L1.40042 89.2104L2.14868 89.049L38.2111 81.2709L38.5317 81.2017L38.596 80.8802L45.196 47.8801L51.4029 80.8745L51.4651 81.2049L51.7944 81.272L88.2104 88.6967L88.9604 88.8496L88.7991 88.1013L81.0209 52.0389L80.9517 51.7183L80.6302 51.654L48.4844 45.2248L81.3446 38.1374L81.6652 38.0682L81.7295 37.7467L88.8006 2.39131L88.9459 1.66492L88.2179 1.80187L52.509 8.51938L52.1786 8.58153L52.1115 8.91088L45.2001 42.8097L37.8874 8.90536ZM44.5383 46.0557L44.5339 46.0769L44.537 46.0763L37.6797 80.3625L2.68611 87.9101L9.89066 52.5735L44.5383 46.0557ZM52.3235 80.3593L45.8221 45.7991L46.0311 45.754L80.1125 52.5703L87.6601 87.5639L52.3235 80.3593ZM80.8132 37.229L46.0234 44.7327L45.8362 44.6952L53.0242 9.44001L87.6747 2.92159L80.8132 37.229ZM2.6716 2.57528L36.979 9.43675L44.5266 44.4304L9.19002 37.2258L2.6716 2.57528Z" fill="#FF2D20"/>
                </svg>
            </div>

            <div class="mt-6">
                <div class="text-gray-900"><strong>Xample.ru</strong></div>
                <div class="text-gray-900">Учитель: <strong>{{user.name}} {{user.surname}}</strong></div>
                <div class="text-gray-900">Код учителя: <strong>{{user.id}}</strong></div>
            </div>

            
        </div>
    
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
