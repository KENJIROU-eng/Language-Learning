<template>
    <div>
        <nav class="p-4 bg-gray-800 text-white flex gap-4">
            <router-link to="/learn/create">Create</router-link>
            <div v-if='showNotice' class="mx-auto bg-sky-500 text-white">
                <p>{{ originalText }}</p>
                <p>{{ translatedText }}</p>
            </div>
            <button @click="logout" class="ml-auto bg-red-500 px-3 py-1 rounded">
                Logout
            </button>
        </nav>
        <main class="p-4">
            <router-view />
        </main>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import axios from './bootstrap.js';
    import { useRouter } from 'vue-router';

    const showNotice = ref(false);
    const originalText = ref('');
    const translatedText = ref('');
    const router = useRouter();

    onMounted(() => {
    // Echo が初期化されているか確認
    if (!window.Echo) {
        console.error('❌ Echo が定義されていません')
        return
    }

    // Pusherイベント受信
    window.Echo.private('NewWords')
        .listen('.notification', (e) => {
        showNotice.value = true
        originalText.value = e.original
        translatedText.value = e.translated

        setTimeout(() => {
            showNotice.value = false
            originalText.value = ''
            translatedText.value = ''
        }, 4000)
        })

    //  APIポーリング
    setInterval(async () => {
        try {
        const response = await axios.get('/api/vue/learn/notice')
        console.log('送信成功:', response.data)
        } catch (error) {
        console.error('エラー:', error)
        }
    }, 30000)
    })

    async function logout() {
        try {
            await axios.post('/logout')
            router.push('/login')
        } catch (error) {
            console.error('❌ Logout failed:', error)
        }
    }

</script>
