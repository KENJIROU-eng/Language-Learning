<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 flex items-center justify-center p-8">
        <div class="flex-row">
            <div class="flex text-white mb-8 text-center mx-auto">
                <div v-if="user">
                    <p><strong>Name:</strong> {{ user.name }}</p>
                    <p><strong>Email:</strong> {{ user.email }}</p>
                </div>
                <div v-else>
                    <p>読み込み中...</p>
                </div>
            </div>
            <div class="relative w-96 h-96 container-3d">
                <div class="absolute inset-0 flex items-center justify-center z-10 pointer-events-none">
                    <div class="text-center text-white">
                        <h1>Choose your action</h1>
                    </div>
                </div>

                <div class="absolute inset-0 z-0 animate-spin-slow">
                    <div class="absolute top-1/2 left-0 transform -translate-x-1/2 -translate-y-1/2 animate-spin-slow-reverse">
                        <div class="cursor-pointer transition-transform duration-300 hover:scale-110" @click="navigateToCreate">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 w-48 h-32 flex flex-col items-center justify-center border border-white/20 hover:bg-blue-500 bg-opacity-10 transition duration-300 shadow-2xl">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h3 class="text-white font-semibold text-lg">Create</h3>
                            <p class="text-purple-200 text-xs text-center">Add new project</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute top-1/2 right-0 transform translate-x-1/2 -translate-y-1/2 animate-spin-slow-reverse">
                        <div class="cursor-pointer transition-transform duration-300 hover:scale-110" @click="navigateToList">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 w-48 h-32 flex flex-col items-center justify-center border border-white/20 hover:bg-green-500 bg-opacity-10 transition duration-300 shadow-2xl">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                            </div>
                            <h3 class="text-white font-semibold text-lg">List</h3>
                            <p class="text-purple-200 text-xs text-center">View all projects</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute inset-0 border-2 border-purple-500/20 rounded-full animate-pulse z-0"></div>
                <div class="absolute inset-4 border border-purple-400/10 rounded-full z-0"></div>

                <div class="absolute -inset-20 overflow-hidden z-0 pointer-events-none">
                    <div class="absolute top-10 left-10 w-2 h-2 bg-purple-400 rounded-full animate-ping"></div>
                    <div class="absolute top-20 right-16 w-1 h-1 bg-blue-400 rounded-full animate-ping animation-delay-1000"></div>
                    <div class="absolute bottom-16 left-20 w-1.5 h-1.5 bg-pink-400 rounded-full animate-ping animation-delay-2000"></div>
                    <div class="absolute bottom-10 right-10 w-2 h-2 bg-green-400 rounded-full animate-ping animation-delay-3000"></div>
                </div>
            </div>
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

const navigateToCreate = () => {
        router.push('/learn/create')
    }

    const navigateToList = () => {
        router.push('/vue/learn/fileList')
    }
    </script>

    <style scoped>
    .container-3d {
        perspective: 1000px;
    }

    @keyframes spin-slow {
        from {
            transform: rotateY(0deg);
        }
        to {
            transform: rotateY(360deg);
        }
    }

    @keyframes spin-slow-reverse {
        from {
            transform: rotateY(0deg);
        }
        to {
            transform: rotateY(-360deg);
        }
    }

    .animate-spin-slow {
        animation: spin-slow 20s linear infinite;
        /* 回転の内部にある子要素も3D空間として扱う */
        transform-style: preserve-3d;
        /* 中心を軸に回転させる。 */
        transform-origin: center center;
    }

    .animate-spin-slow-reverse {
        animation: spin-slow-reverse 20s linear infinite;
        /* 回転の内部にある子要素も3D空間として扱う */
        transform-style: preserve-3d;
        /* 中心を軸に回転させる。 */
        transform-origin: center center;
    }

    .animation-delay-1000 {
        animation-delay: 1s;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-3000 {
        animation-delay: 3s;
    }

</style>
