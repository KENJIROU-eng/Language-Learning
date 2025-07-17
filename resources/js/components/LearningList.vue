<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 flex items-center justify-center p-8">
        <div class="w-full max-w-6xl bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-3xl shadow-2xl p-8">

        <!-- 上部ナビゲーション -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold flex items-center gap-2">
            📚 Word Lists
            </h1>
            <router-link
            to="/vue/learn/fileList"
            class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white text-sm md:text-base font-bold px-6 py-2 rounded-lg shadow hover:scale-105 transition duration-300"
            >
            ← Back to File Lists
            </router-link>
        </div>

        <!-- テーブル -->
        <div class="overflow-x-auto rounded-xl shadow-inner">
            <table class="min-w-full text-sm text-left text-white border-collapse">
            <thead class="bg-white/20 text-xs uppercase tracking-wide">
                <tr>
                <th class="px-4 py-3">📄 File Name</th>
                <th class="px-4 py-3 text-yellow-300">Japanese</th>
                <th class="px-4 py-3 text-blue-300">English</th>
                <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                <tr
                v-for="word in allWords" :key="word.id"
                class="border-t border-white/10 hover:bg-white/10 transition duration-200"
                >
                <td class="px-4 py-3 font-semibold"> {{ formatDate(word.created_at) }}</td>
                <td class="px-4 py-3 text-yellow-100">{{ word.originalText }}</td>
                <td class="px-4 py-3 text-blue-100">{{ word.translatedText }}</td>
                <td class="px-4 py-3 text-right">
                </td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</template>
<!-- <template>
    <div class= "mt-5 h-[880px]">
        <div class="w-9/10 md:w-4/5 mx-auto sm:px-6 lg:px-8 h-full">
            <div class="min-h-screen bg-gray-100 dark:bg-gray-800 py-6 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <router-link to="/vue/learn/fileList" class="bg-blue-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-blue-600 transition">
                        Back to file Lists
                    </router-link>
                    <div class="relative text-center border-gray-300 pb-4">
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100 flex justify-center items-center">
                                word-Lists
                            </h1>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200 border border-gray-300">
                            <thead class="bg-gray-200 dark:bg-gray-700 text-xs uppercase tracking-wider">
                                <tr>
                                    <th class="px-4 py-2">File (Date)</th>
                                    <th class="px-4 py-2">Japanese Words</th>
                                    <th class="px-4 py-2">English Words</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="word in allWords" :key="word.id" class="border-t border-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-4 py-3">
                                        {{ formatDate(word.created_at) }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ word.originalText }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ word.translatedText }}
                                    </td>
                                    <td class="px-4 py-3">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template> -->

<script setup>

import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from '../bootstrap.js';

const route = useRoute();
const fileName = route.params.fileName;

function formatDate(dateStr) {
    const date = new Date(dateStr);
    const y = date.getFullYear();
    const m = String(date.getMonth() + 1).padStart(2, '0'); //0~表示
    const d = String(date.getDate()).padStart(2, '0');
    return `${y}-${m}-${d}`;
}

const allWords = ref([]);
onMounted(async () => {
try {
    const response = await axios.get(`/api/vue/learn/${fileName}/index`);
    allWords.value = response.data.all_words;
} catch (error) {
    console.error('❌ API fetch failed:', error);
}
});
</script>
