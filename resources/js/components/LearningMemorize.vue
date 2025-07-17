<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 flex items-center justify-center p-6">
        <div class="w-full max-w-4xl bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl shadow-2xl text-white p-8">

        <!-- ヘッダー -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold flex items-center gap-2">🧠 Memorize Mode</h1>
            <router-link
            to="/vue/learn/fileList"
            class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white text-sm md:text-base font-bold px-6 py-2 rounded-lg hover:scale-105 transition duration-300"
            >
            ← Back to Word Lists
            </router-link>
        </div>

        <!-- スタートボタン -->
        <div class="text-center mb-8">
            <button
            v-if="!isActive"
            @click="showOriginalCard"
            class="bg-green-500 hover:bg-green-600 text-white font-bold text-lg px-6 py-2 rounded-md shadow-md transition"
            >
            Start Memorization
            </button>
        </div>

        <!-- 単語カード表示 -->
        <div class="flex flex-col md:flex-row justify-center items-center gap-8">
            <!-- 英語カード -->
            <div v-if="isActive" class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 w-full max-w-sm shadow-lg border border-white/20">
            <h2 class="text-xl font-semibold mb-2 text-center">English</h2>
            <p class="text-center text-2xl font-bold text-white mb-4">
                {{ wordSet[counter][0] }}
            </p>
            <button
                v-if="!isAnswered"
                @click="showAnswer"
                class="mx-auto block mt-2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold px-6 py-2 rounded-md transition"
            >
                Show Answer
            </button>
            </div>

            <!-- 日本語カード -->
            <div v-if="isAnswered" class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 w-full max-w-sm shadow-lg border border-white/20">
            <h2 class="text-xl font-semibold mb-2 text-center">Japanese</h2>
            <p class="text-center text-2xl font-bold text-white mb-4">
                {{ wordSet[counter][1] }}
            </p>
            <button
                @click="nextQuiz"
                class="mx-auto block mt-2 bg-purple-500 hover:bg-purple-600 text-white font-bold px-6 py-2 rounded-md transition"
            >
                Next
            </button>
            </div>
        </div>

        <!-- カウンター -->
        <p class="text-center text-sm text-white/60 mt-8">
            {{ counter + 1 }} / {{ count }} words
        </p>
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
