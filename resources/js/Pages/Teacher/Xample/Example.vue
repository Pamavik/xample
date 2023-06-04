<template>
    <div class="relative">
        <!-- Page Content -->
        <div class="w-full bg-white border rounded-lg p-4 my-4">
            {{ question }}
        </div>
        <div id="answer" class="w-full bg-white border rounded-lg p-4 my-4 flex flex-wrap">
            <div class="grow mr-4 flex flex-wrap">
                {{ sanswer}}
            </div>
            <div class="self-end justify-self-end">
                <button @click="delword()" :disabled="answers.length === 0" class="border border-emerald-500 hover:bg-emerald-600 focus:outline-none rounded-lg px-2 py-0.5 text-emerald-600 hover:text-white font-semibold shadow">&larr;</button>
            </div>
        </div>
        <div class="w-full bg-white border rounded-lg px-4 pt-4 my-4 flex flex-wrap">
            <span v-for="(word, index) in shuffledWords" :key="index" @click="addword(word)"
                class="cursor-pointer mr-4 mb-4 hover:bg-gray-200 inline-block bg-gray-100 border rounded-lg flex justify-between items-center px-4 py-2">
                {{word}}
            </span>
        </div>
        <div>
            <PrimaryButton @click="checkAnswer()" :disabled="answers.length === 0">Проверить</PrimaryButton>
        </div>
        <ModalDialog v-if="displayModal" question="Нет знака препинания в конце предложения. Продолжить?" :onConfirm="confirm"  :onCancel="cancel"/>
    </div>
</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ModalDialog  from "@/Components/ModalDialog.vue";
export default {
    name: 'Example',
    props: [
        'question',
        'answer',
        'words'
    ],
    components: {
        PrimaryButton,
        ModalDialog
    },
    data() {
        return {
            //question: "Привет! Как тебя зовут?",
            //answer: "Hello! What is your name?",
            answers: [],
            //words: ["what", "I", "you", "are", "am", "Hello", "he", "is", "name", "your", "?", "!"],
            wordList: [],
            timer: null,
            displayModal: false,
        }
    },
    mounted() {
        function checkSymbol(str, char){
            let arr = [];
            let i = str.indexOf(char);
            while (i>0) {          
                str = str.replace(char,'');
                arr.push(char);
                i = str.indexOf(char);
            }
            if(arr.length){
                str = str + ' ' + arr.join(' ')
            }
            return str;
        }
        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                let j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }
        let w = this.words;
        //w = checkSymbol(w, '?');
        //w = checkSymbol(w, '.');
        //w = checkSymbol(w, ',');
        //w = checkSymbol(w, '!');
        let arr = w.split(' ');
        arr = shuffle(arr);
        this.wordList = arr;

    },
    computed: {
        shuffledWords() {
            return this.wordList.sort(() => Math.random() - 0.5);
        },
        sanswer() {
            let  str = this.answers.join(' ');
            let arr = str.split(' ? ');
            arr.forEach(function(item, i, arr) {
                arr[i] = item.charAt(0).toUpperCase() + item.slice(1);
                
            });
            str = arr.join(' ? ');

            arr = str.split(' ! ');
            arr.forEach(function(item, i, arr) {
                arr[i] = item.charAt(0).toUpperCase() + item.slice(1);
            });
            str = arr.join(' ! ');

            arr = str.split(' . ');
            arr.forEach(function(item, i, arr) {
                arr[i] = item.charAt(0).toUpperCase() + item.slice(1);
            });
            str = arr.join(' . ');

            str = str.replace(' ?', '?');
            str = str.replace(' !', '!');
            str = str.replace(' .', '.');
            str = str.replace(' ,', ',');
            return str;
        }
    },
    methods: {
        delword(){
            let word = this.answers.pop();
            this.wordList.push(word);
        },
        addword(word) {
            let index = this.wordList.indexOf(word);
            this.answers.push(word);
            this.wordList.splice(index, 1); 
            let self = this;
            if (this.sanswer == this.answer) {
                this.timer = setTimeout(function(){
                    self.checkAnswer();
                }, 250);
            }
        },
        checkAnswer(confirm = false) {
            let a = this.sanswer;
            let answer = this.answer;
            let lsa = a.slice(-1);
            let la = answer.slice(-1);
            if ((lsa != la)&&(!confirm)) {
                this.displayModal = true;
                return;
            }
            if (answer == a) {
                this.$emit('successQuestion');
            }else {
                this.$emit('errorQuestion', 'Правильный ответ: '+this.answer, a);
            }
            
        },
        confirm() {
            this.displayModal = false;
            this.checkAnswer(true);
        },
        cancel() {
            this.displayModal = false;
        },
    },
    unmounted() {
        clearInterval(this.timer)
    }
}
</script>