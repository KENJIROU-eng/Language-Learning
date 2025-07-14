<template>
    <div class= "mt-5 h-[880px]">
        <div class="w-9/10 md:w-4/5 mx-auto sm:px-6 lg:px-8 h-full">
            <div class="min-h-screen bg-gray-100 dark:bg-gray-800 py-6 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <router-link to="/vue/learn/fileList" class="ml-auto bg-blue-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-blue-600 transition">
                        Back to word Lists
                    </router-link>
                    <div class="text-center border-gray-300 pb-4">
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100 justify-center items-center">
                                Memorize word lists
                            </h1>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <button v-if="!isActive" @click = "showOriginalCard" class="block mt-4 mb-4 mx-auto bg-green-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-green-600 transition">
                            Start
                        </button>
                        <div class="flex justify-center justify-items-center w-4/5 mx-auto">
                            <div :class="originalCard">
                                <div class="w-full h-[150px] bg-orange-500">
                                    <h1 class="text-center pr-2 font-bold text-white">English</h1>
                                    <p v-if="wordSet.length" class=" my-auto text-center text-white">{{ wordSet[counter][0] }}</p>
                                </div>
                                <button @click = "showAnswer" class="block mt-4 mb-4 mx-auto bg-green-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-green-600 transition">
                                    Answer
                                </button>
                            </div>
                            <div :class="answerCard">
                                <div class="w-full h-[150px] bg-orange-500 opacity-75">
                                    <h1 class="text-center pr-2 font-bold text-white">Japanese</h1>
                                    <p v-if="wordSet.length" class="my-auto text-center text-white">{{ wordSet[counter][1] }}</p>
                                </div>
                                <button @click = "nextQuiz" class="block mt-4 mb-4 mx-auto bg-green-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-green-600 transition">
                                    Next
                                </button>
                            </div>
                        </div>
                        <p class="opacity-0 mx-auto text-center">Counter: {{ counter + 1 }} / {{ count }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import { ref, onMounted, computed, nextTick } from 'vue';
import { useRoute } from 'vue-router';
import axios from '../bootstrap.js';

const route = useRoute();
const fileName = route.params.fileName;

const wordSet = ref([]);
const isActive = ref(false);
const isAnswered = ref(false);
let counter = ref(0);
const count = computed(() => wordSet.value.length);//更新可能

onMounted(async () => {
try {
    const response = await axios.get(`/api/vue/learn/${fileName}/memorize`);
    wordSet.value = response.data.wordSet;
} catch (error) {
    console.error('❌ API fetch failed:', error);
}
});
//Start game
const originalCard = computed(() =>
    isActive.value ? 'w-full' : 'opacity-0 w-full'
);
function showOriginalCard() {
    isActive.value = !isActive.value;
}
//Answer the quiz
const answerCard = computed(() =>
    isAnswered.value ? 'w-full' : 'opacity-0 transition-all translate-x-5 duration-700 w-full'
);
function showAnswer() {
    isAnswered.value = !isAnswered.value;
}
//Next Quiz
async function nextQuiz() {
    counter.value = (counter.value + 1 >= count.value) ? 0 : counter.value + 1;
    await nextTick(); // DOMの更新を待つ
    showAnswer();
}

</script>
