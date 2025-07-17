
<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 flex items-center justify-center p-8">
        <div class="w-full max-w-6xl bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-3xl shadow-2xl p-8">

        <!-- 上部ナビゲーション -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white flex items-center gap-2">
            📁 File Lists
            </h1>
            <router-link
            to="/learn/create"
            class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white text-sm md:text-base font-bold px-6 py-2 rounded-lg shadow hover:scale-105 transition duration-300"
            >
            ← Back to Create
            </router-link>
        </div>

        <!-- テーブル -->
        <div class="overflow-x-auto rounded-xl shadow-inner">
            <table class="min-w-full text-sm text-left text-white border-collapse">
            <thead class="bg-white/20 text-xs uppercase tracking-wide">
                <tr>
                <th class="px-4 py-3">📄 File Name</th>
                <th class="px-4 py-3">🔢 Amount</th>
                <th class="px-4 py-3">🧠 Status</th>
                <th class="px-4 py-3"></th>
                <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                <tr
                v-for="word in fileDetail" :key="word.date"
                class="border-t border-white/10 hover:bg-white/10 transition duration-200"
                >
                <td class="px-4 py-3 font-medium">{{ word.date }}</td>
                <td class="px-4 py-3">{{ word.count }}</td>
                <td class="px-4 py-3 italic text-purple-300">-</td>
                <td class="px-4 py-3">
                    <router-link
                    :to="`/vue/learn/${word.date}/index`"
                    class="inline-block bg-gradient-to-r from-blue-600 to-indigo-500 text-white text-sm px-4 py-2 rounded-md shadow hover:scale-105 transition"
                    >
                    📚 View
                    </router-link>
                </td>
                <td class="px-4 py-3">
                    <router-link
                    :to="`/vue/learn/${word.date}/memorize`"
                    class="inline-block bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm px-4 py-2 rounded-md shadow hover:scale-105 transition"
                    >
                    🧠 Memorize
                    </router-link>
                </td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</template>

<script setup>

import { ref, onMounted } from 'vue';
import axios from '../bootstrap.js';

const fileDetail = ref([]);

onMounted(async () => {
try {
    const response = await axios.get('/api/vue/learn/fileList');
    fileDetail.value = response.data.fileDetail;
} catch (error) {
    if (error.response) {
        console.error('❌ API error response:', error.response.data);
        console.error('❌ Status:', error.response.status);
        console.error('❌ Headers:', error.response.headers);
    } else if (error.request) {
        console.error('❌ No response received:', error.request);
    } else {
        console.error('❌ Error setting up request:', error.message);
    }
}
});
</script>
