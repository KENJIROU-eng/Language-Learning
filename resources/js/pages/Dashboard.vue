<template>
    <div class="p-4">
        <h1 class="text-xl font-bold">ダッシュボード</h1>
        <div v-if="user">
        <p><strong>Name:</strong> {{ user.name }}</p>
        <p><strong>Email:</strong> {{ user.email }}</p>
        </div>
        <div v-else>
        <p>読み込み中...</p>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from '../bootstrap.js'

const user = ref(null)
const error = ref('')

onMounted(async () => {
    try {
        const res = await axios.get('/api/user') 
        user.value = res.data
    } catch (e) {
        console.error('認証に失敗しました', e)
        error.value = 'ユーザー情報の取得に失敗しました'
    }
});
</script>
