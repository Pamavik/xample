<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Example from '@/Components/Examples/Example.vue';
import ExampleStart from '@/Components/Examples/ExampleStart.vue';
import ExampleMessage from '@/Components/Examples/ExampleMessage.vue';
import ExampleFinish from '@/Components/Examples/ExampleFinish.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
const props = defineProps(['user', 'xample']);

const questionsMax = props.xample.items.length;
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
    let array = props.xample.items;
    for (let i = array.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    props.xample.items.question = array;
})

function startXample() {
    state.value = 'question';
}
function nextQuestion() {
    question.value++
    if(question.value < props.xample.items.length) {
        state.value='question'
    }
    else{
        state.value='finish'
    }
}
function successQuestion() {
    state.value='message';
    message.value.type="emerald";
    message.value.text="Всё верно, молодец!";
    stats.value.success++;
}
function errorQuestion(msg, answer) {
    console.log(answer);
    state.value='message';
    message.value.type="red";
    message.value.text=msg;
    stats.value.error++;
}

function endXample() {
    router.get('/dashboard');
}

const TestDone = computed(() => stats.value.success + stats.value.error);
const ProgressStyle = computed(() => TestDone.value / questionsMax * 100);
</script>

<template>
    <Head title="Упражнение" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Упражнение</h2>
        </template>

        <div class="my-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h1 class="text-2xl font-semibold mb-2 lg:mb-0">{{props.xample.title}}</h1>
                    <div class="w-full bg-white border box-content rounded-lg h-4 my-4">
                        <div :style="{ width: ProgressStyle + '%' }" class="bg-emerald-800 h-4 rounded-lg">

                        </div>
                    </div>
                    <TransitionGroup name="flip">
                        <ExampleStart v-if="state === 'start'" 
                            :description="props.xample.description"
                            @startXample="startXample"
                        ></ExampleStart> 
                        <Example v-if="state === 'question'" :question="props.xample.items[question].question" 
                                :answer="props.xample.items[question].answer" 
                                :words="props.xample.items[question].words"
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
    </AuthenticatedLayout>
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
