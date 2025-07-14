<template>
    <div class="max-w-md mx-auto p-4">
        <h2 class="text-xl mb-4">Register</h2>
        <form @submit.prevent="register">
            <input v-model="name" type="text" placeholder="Name" class="input" />
            <input v-model="email" type="email" placeholder="Email" class="input" />
            <input v-model="password" type="password" placeholder="Password" class="input" />
            <input v-model="password_confirmation" type="password" placeholder="Password_confirmation" class="input" />
        <button type="submit" class="btn">Register</button>
        </form>
        <p v-if="error" class="text-red-500 mt-2">{{ error }}</p>
        <router-link to="/login">Login</router-link>
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    import axios from '../bootstrap.js'
    import { useRouter } from 'vue-router'

    const name = ref('')
    const email = ref('')
    const password = ref('')
    const password_confirmation = ref('')
    const router = useRouter()

    async function register() {
        try {
            await axios.get('/sanctum/csrf-cookie') // 必須
            await axios.post('/register', {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value
            })
            router.push('/dashboard') // 登録後ダッシュボードへ
        } catch (error) {
            console.error('登録失敗:', error)
        }
    }
</script>

<style scoped>
    .input {
        display: block;
        margin-bottom: 10px;
        padding: 8px;
        width: 100%;
    }
    .btn {
        padding: 8px 16px;
        background: #4f46e5;
        color: white;
        border: none;
        border-radius: 5px;
    }
</style>
