<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Wysiwyg from '@/Components/Wysiwyg.vue';
import SimplePagination from '@/Components/SimplePagination.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';
import _ from 'lodash';

defineProps(['sentences']);

const form = useForm({
    title: '',
    description: '',
    items: [],
});


const newQuestion = reactive({ 
    question: '', 
    answer: '',
    words: '',
});

const term = ref('');

const search = _.throttle(function() {

        router.get(route('teacher.xamples.create'), {term: term.value}, { preserveState: true, preserveScroll: true });

}, 200);

function addQuestion() {
  form.items.push({question: newQuestion.question,
    answer: newQuestion.answer,
    words: newQuestion.words
    });
}

function deleteItem(index) {
  form.items.splice(index, 1);
}

const panel = reactive({
    visible: false,
    top: 0
});

function showSentence(){  
    router.reload({ only: ['sentences'], preserveState: true });
    panel.visible = true;
    panel.top = window.pageYOffset;
}

function selectSentence(sentence){  
    newQuestion.question = sentence.question;
    newQuestion.answer = sentence.answer;
    newQuestion.words = sentence.words;
    panel.visible = false;
}

function close(){
    panel.visible = false;
}
</script>

<template>
    <Head>
        <title>Xamples</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Упражнения</h1>
        </template>
            <div class="max-w-7xl mx-auto sm:px-2 relative">
            
                <div class="m-6">
                <Link :href="route('teacher.xamples.index')" class="my-6 text-emerald-500 hover:text-gray-800">Назад</Link>
                    <form @submit.prevent="form.post(route('teacher.xamples.store'), { onSuccess: () => form.reset() })">
                    <div class="my-4">
                        <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow">Создать</button>
                    </div>
                    <InputLabel for="title" value="Заголовок упражнения" />

                    <TextInput
                        id="title"
                        type="text"
                        class="mt-1 block w-full mb-4 p-2 outline-none border-gray-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 rounded-md shadow-sm"
                        v-model="form.title"
                        required
                    />
                    <InputError :message="form.errors.title" class="mt-2 mb-4" />

                    <InputLabel for="description" value="Описание упражнения" />
                    <Wysiwyg id="description" :value="form.description" @update:value="newValue => form.description = newValue"/>
                    <InputError :message="form.errors.description" class="mt-2 mb-4" />
                </form>
                    <div class="mt-4">
                        <InputError :message="form.errors.items" class="mt-2 mb-4" />
                        <h3 class="block font-medium text-sm text-gray-700">Вопросы:</h3>
                        <div class="w-full bg-white border rounded-lg px-4 pt-4 my-4">
                            <div  class="mb-4 hover:bg-gray-200 inline-block bg-gray-100 border rounded-lg flex justify-between items-center px-4 py-2"
                                v-for="(item, index) in form.items"
                                :key="index"
                            > 
                                <div class="grow">
                                    <div>
                                        <InputLabel :for="'question'+(index+1)" value="Вопрос" />
                                        <TextInput
                                            :id="'question'+(index+1)"
                                            type="text"
                                            class="mt-1 block w-full mb-4"
                                            v-model="item.question"
                                        />
                                    </div>
                                    <div>
                                        <InputLabel :for="'answer'+(index+1)" value="Ответ" />
                                        <TextInput
                                            :id="'answer'+(index+1)"
                                            type="text"
                                            class="mt-1 block w-full mb-4"
                                            v-model="item.answer"
                                        />
                                    </div>
                                    <div>
                                        <InputLabel :for="'words'+(index+1)" value="Ответ" />
                                        <TextInput
                                            :id="'words'+(index+1)"
                                            type="text"
                                            class="mt-1 block w-full mb-4"
                                            v-model="item.words"
                                        />
                                    </div>
                                </div>
                                <div class="self-start">
                                    <button @click="deleteItem(index)" class="font-black block cursor-pointer text-emerald-400 hover:bg-gray-200 h-6 flex items-center">
                                        X
                                    </button>
                                </div>

                            </div>

                            <!-- Add Question-->
                            <div  class="mb-4 hover:bg-gray-200 inline-block bg-gray-300 border rounded-lg flex justify-between items-center px-4 py-2">
                                <div class="w-full">
                                    <h3 class="block font-medium text-sm text-gray-700 mb-2">Добавить вопрос</h3>
                                    <div>
                                        <InputLabel for="newquestion" value="Вопрос" />
                                        <TextInput
                                            id="newquestion"
                                            type="text"
                                            class="mt-1 block w-full mb-4"
                                            v-model="newQuestion.question"
                                        />
                                    </div>
                                    <div>
                                        <InputLabel for="newanswer" value="Ответ" />
                                        <TextInput
                                            id="newanswer"
                                            type="text"
                                            class="mt-1 block w-full mb-4"
                                            v-model="newQuestion.answer"
                                        />
                                    </div>
                                    <div>
                                        <InputLabel for="newwords" value="Слова для ответа" />
                                        <TextInput
                                            id="newwords"
                                            type="text"
                                            class="mt-1 block w-full mb-4"
                                            v-model="newQuestion.words"
                                        />
                                    </div>
                                    <div class="mt-4">
                                        <button @click.stop="addQuestion" class="bg-emerald-500 hover:bg-emerald-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow">Добавить вопрос</button>
                                    </div>
                                    <div class="mt-4">
                                        <button @click.stop="showSentence" class="bg-gray-500 hover:bg-emerald-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow">Выбрать из библиотеки</button>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- Select Sentence-->
            <div v-if="panel.visible" class="absolute block left-2 rounded-lg right-2 z-[1000] mt-0 border-none bg-white bg-clip-padding shadow-lg shadow-black/5 p-6 top-0"
            :style="{ top: panel.top + 'px' }">
                            <InputLabel for="term" value="Поиск" />

                            <TextInput
                                id="term"
                                type="text"
                                class="mt-1 block w-full mb-4 p-2 outline-none border-gray-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 rounded-md shadow-sm"
                                v-model="term"
                                @keyup="search"
                            />
                            <table v-if="sentences" class="border-collapse border border-emerald-500 table-auto w-full my-4">
                                <thead>
                                    <tr>
                                    <th class="border-collapse border border-emerald-500 text-left p-2 bg-emerald-500 text-white">Фраза ответа</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(sentence, index) in sentences.data"
                                    :key="sentence.id">
                                        <td class="border-collapse border border-emerald-500 p-2 cursor-pointer" @click="selectSentence(sentence)">
                                            {{sentence.answer}}
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <SimplePagination  v-if="sentences" :prev_page_url="sentences.prev_page_url" :next_page_url="sentences.next_page_url" />
                            <div class="absolute right-0 top-0">
                                <button @click="close()" class="font-black block rounded-lg cursor-pointer text-emerald-500 hover:bg-emerald-500 hover:text-white h-6 flex items-center p-4">
                                    X
                                </button>
                            </div>
                            
                        </div>
        </div>
        <div v-if="panel.visible" class="fixed top-0 left-0 bottom-0 right-0 z-50 bg-gray-500 opacity-50"></div>
    </AuthenticatedLayout>
</template>
