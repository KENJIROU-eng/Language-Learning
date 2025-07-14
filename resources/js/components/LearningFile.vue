
<template>
    <div class= "mt-5 h-[880px]">
        <div class="w-9/10 md:w-4/5 mx-auto sm:px-6 lg:px-8 h-full">
            <div class="min-h-screen bg-gray-100 dark:bg-gray-800 py-6 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <router-link to="/learn/create" class="bg-blue-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-blue-600 transition">
                        Back to Create
                    </router-link>
                    <div class="relative text-center border-gray-300 pb-4">
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100 flex justify-center items-center">
                                file-Lists
                            </h1>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200 border border-gray-300">
                            <thead class="bg-gray-200 dark:bg-gray-700 text-xs uppercase tracking-wider">
                                <tr>
                                    <th class="px-4 py-2">File (Date)</th>
                                    <th class="px-4 py-2">Amount</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2"></th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="word in fileDetail" :key="word.date" class="border-t border-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-4 py-3">
                                        {{ word.date }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ word.count }}
                                    </td>
                                    <td class="px-4 py-3">
                                    </td>
                                    <td class="px-4 py-3">
                                        <router-link :to="`/vue/learn/${word.date}/index`" class="bg-blue-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-blue-600 transition">
                                            view word-Lists
                                        </router-link>
                                    </td>
                                    <td class="px-4 py-3">
                                        <router-link :to="`/vue/learn/${word.date}/memorize`" class="bg-green-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-green-600 transition">
                                            Memorize
                                        </router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
