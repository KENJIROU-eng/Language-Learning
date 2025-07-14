import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '../stores/pinia.js'


// ページ（ビュー）コンポーネントを読み込む
import LearningComponent from '../components/LearningComponent.vue';
import LearningCreate from '../components/LearningCreate.vue';
import LearningFile from '../components/LearningFile.vue';
import LearningList from '../components/LearningList.vue';
import LearningMemorize from '../components/LearningMemorize.vue';
import RegisterPage from '../pages/RegisterPage.vue';
import LoginPage from '../pages/LoginPage.vue';
import Dashboard from '../pages/Dashboard.vue';

const routes = [
    { path: '/', redirect: '/dashboard'},//初期ページの指定
    { path: '/register', name: 'register', component: RegisterPage, meta: { requiresAuth: false }},
    { path: '/login', name: 'login', component: LoginPage, meta: { requiresAuth: false }},
    { path: '/dashboard', name: 'dashboard', component: Dashboard, meta: { requiresAuth: true }},
    { path: '/vue/test', component: LearningComponent, meta: { requiresAuth: true }},
    { path: '/learn/create', component: LearningCreate, meta: { requiresAuth: true }},
    { path: '/vue/learn/fileList', component: LearningFile, meta: { requiresAuth: true }},
    { path: '/vue/learn/:fileName/index', component: LearningList, meta: { requiresAuth: true }},
    { path: '/vue/learn/:fileName/memorize', component: LearningMemorize, meta: { requiresAuth: true }},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const publicPages = ['/login', '/register']
    const authRequired = !publicPages.includes(to.path)
    const authStore = useAuthStore()

    await authStore.fetchUser()

    if (authRequired && !authStore.user) {
        return next('/login')
    }

    if (to.path === '/login' && authStore.user) {
        return next('/dashboard')
    }

    return next()
})

export default router;
