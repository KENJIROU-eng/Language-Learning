<template>
    <div class="max-w-md mx-auto mt-10">
        <h2 class="text-xl font-bold mb-4">ログイン</h2>
        <form @submit.prevent="login">
        <input v-model="email" type="email" placeholder="Email" class="input mb-2" required />
        <input v-model="password" type="password" placeholder="Password" class="input mb-4" required />
        <button class="bg-blue-500 text-white px-4 py-2 rounded">ログイン</button>
        </form>
        <p v-if="error" class="text-red-500 mt-2">{{ error }}</p>
        <router-link to="/register">Register</router-link>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from '../bootstrap.js' // axiosの初期設定ファイル
import { useAuthStore } from '../stores/pinia.js'

const email = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

async function login() {
    error.value = ''

    try {
        // CSRF保護トークン取得
        await axios.get('/sanctum/csrf-cookie')

        // ログインリクエスト送信
        const res = await axios.post('/login', {
            email: email.value,
            password: password.value
        })

        const authStore = useAuthStore()
        await authStore.fetchUser() // ログイン後に取得

        // 成功したらルートへ遷移
        router.push('/dashboard')

    } catch (e) {
        // エラーハンドリング
        if (e.response && e.response.data && e.response.data.message) {
            error.value = e.response.data.message
        } else {
            error.value = 'Login failed'
        }
    }
}

</script>

<style scoped>
.input {
    display: block;
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ccc;
}
</style>
