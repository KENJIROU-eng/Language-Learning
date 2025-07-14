import { defineStore } from 'pinia'
import axios from '../bootstrap.js'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        checked: false, // 認証チェック済みかどうか
    }),
    actions: {
        async fetchUser() {
        if (this.checked) return
        try {
            const res = await axios.get('/api/user')
            this.user = res.data
        } catch (e) {
            this.user = null
        } finally {
            this.checked = true
        }
        },
        logout() {
        this.user = null
        this.checked = false
        }
    }
})
