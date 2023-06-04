<script setup>
    import { defineEmits, reactive, onMounted } from 'vue'
    import { router } from '@inertiajs/vue3';

    //const emit = defineEmits(['confirm', 'cancel'])
    const sentences = reactive({});

    onMounted(() => {
      Inertia.get('/sensences');
})
</script>

<template>
    <div class="flex justify-center items-center w-full h-full fixed top-0 bottom-0 left-0 right-0 p-4 z-40" style="background: rgba(0,0,0,0.5">
    <div class="bg-white mx-auto p-4 rounded-lg max-w-md flex-col relative h-min">
      <span class="absolute right-4 top-2 cursor-pointer" @click="emit('cancel')">🗙</span>
      <h2 class="font-semibold mb-4 mt-6">{{ question }}</h2>
      <div class="flex flex-row justify-between">
        <button class="bg-emerald-500 hover:bg-emerald-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow"
            @click="emit('confirm')">Подтвердить</button>
        <button class="bg-slate-500 hover:bg-slate-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow ml-4"
            @click="emit('cancel')">Отмена</button>
      </div>
    </div>
  </div>
</template>


<style>
  .modal-container {

    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background-color: #cececeb5;
  }
  .modal-body {
    background-color: #fff;
    border: 2px solid #74a2cf;
    border-radius: 10px;
    text-align: center;
    padding: 20px 40px;
    min-width: 250px;
    display: flex;
    flex-direction: column;
  }
  .modal-action {
    display: flex;
    flex-direction: row;
    gap: 40px;
    justify-content: center;
  }
  .modal-button {
    cursor: pointer;
    height: 30px;
    padding: 0 25px;
    border: 2px solid #74a2cf;
    border-radius: 5px;
    background-color: #80b2e4;
    color: #fff;
  }
  .modal-close {
    cursor: pointer;
    position: absolute;
    align-self: end;
    right: -33px;
    top: -17px;
  }
</style>