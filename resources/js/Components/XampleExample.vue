<script setup>
import Example from '@/Components/Examples/Example.vue';
import ExampleStart from '@/Components/Examples/ExampleStart.vue';
import ExampleMessage from '@/Components/Examples/ExampleMessage.vue';
import ExampleFinish from '@/Components/Examples/ExampleFinish.vue';
import { ref, reactive, computed, onMounted } from 'vue';
const xample = reactive({
    title: 'Пример упражнения',
    description: 'Составьте из слов преревод фразы',
    items: [ { "question": "Кошки любят молоко.", "answer": "Cats like milk.", "words": "cats like milk want water ." }, { "question": "Я живу в Лондоне.", "answer": "I live in London.", "words": "I live in London lived at me ." }, { "question": "Я читаю книгу.", "answer": "I read a book.", "words": "I read a book books am reading ." }, { "question": "Мы работаем в Нью-Йорке", "answer": "We work in New York.", "words": "we work in New York you London worked ." }, { "question": "Я играю в мяч", "answer": "I play a ball", "words": "I play plays played a an ball we" } ]

});
const questionsMax = xample.items.length;
const state = ref('start');
const question = ref(0);
const message = ref({
    type: 'success',
    text: 'OK'
});

const stats = ref({
    success: 0,
    error: 0
});

onMounted(() => {
    let array = xample.items;
    for (let i = array.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    xample.items.question = array;
})

function startXample() {
    state.value = 'question';
}
function nextQuestion() {
    question.value++
    if(question.value < xample.items.length) {
        state.value='question'
    }
    else{
        state.value='finish';
    }
}
function successQuestion() {
    state.value='message';
    message.value.type="emerald";
    message.value.text="Всё верно, молодец!";
    stats.value.success++;
}
function errorQuestion(answer, question) {
    state.value='message';
    message.value.type="red";
    message.value.text = "Неправильный ответ: " + answer;
    stats.value.error++;
}

function endXample() {
    state.value='start';
    stats.value.error = 0;
    stats.value.success = 0;
    question.value = 0;
    let array = xample.items;
    for (let i = array.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    xample.items.question = array;
}

const TestDone = computed(() => stats.value.success + stats.value.error);
const ProgressStyle = computed(() => TestDone.value / questionsMax * 100);
</script>

<template>
        <div class="my-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mt-6">
                    <h1 class="text-2xl font-semibold text-gray-800 mb-2 lg:mb-0">{{xample.title}}</h1>
                    <div class="w-full bg-white border box-content rounded-lg h-4 my-4">
                        <div :style="{ width: ProgressStyle + '%' }" class="bg-emerald-800 h-4 rounded-lg">

                        </div>
                    </div>
                    <TransitionGroup name="flip">
                        <ExampleStart v-if="state === 'start'" 
                            :description="xample.description"
                            @startXample="startXample"
                        ></ExampleStart> 
                        <Example v-if="state === 'question'" :question="xample.items[question].question" 
                                :answer="xample.items[question].answer" 
                                :words="xample.items[question].words"
                                @successQuestion="successQuestion"
                                @errorQuestion="errorQuestion"
                        />
                        <ExampleMessage v-if="state === 'message'" 
                            :type="message.type"
                            :text="message.text"
                            @nextQuestion="nextQuestion"
                        ></ExampleMessage>
                        <ExampleFinish v-if="state === 'finish'" 
                            :stats="stats"
                            @endXample="endXample"
                        ></ExampleFinish>
                    </TransitionGroup>
                </div>
            </div>
        </div>
</template>

<style>
.flip-enter-active {
    animation: flipInX 0.25s linear;
}

.flip-leave-active {
    animation: flipOutX 0.25s linear;
}

@keyframes flipInX {
    from{
        transform: translateY(50px);
        opacity: 0;
    }
    to{
        transform: translateY(0);
        opacity: 1;
    }
}
@keyframes flipOutX {
    from{
        transform: translateY(0);
        opacity: 1;
    }
    to{
        transform: translateY(-50px);
        opacity: 0;
    }
}
</style>
