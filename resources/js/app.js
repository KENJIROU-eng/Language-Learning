import './bootstrap';
import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
//Pusher and Laravel Echo initialization
window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: "pusher",
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    encrypted: true,
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    authorizer: (channel, options) => {
        return {
            authorize: (socketId, callback) => {
                axios.post('/api/broadcasting/auth', {
                    socket_id: socketId,
                    channel_name: channel.name
                })
                .then(response => {
                    callback(false, response.data);
                })
                .catch(error => {
                    callback(true, error);
                });
            }
        };
    },
})
//pusherへの接続状態を確認（デバック用）
window.Echo.connector.pusher.connection.bind('connected', () => {
        console.log(':チェックマーク_緑: Pusher に接続されました');
    });
    window.Echo.connector.pusher.connection.bind('connected', () => {
        console.log(':チェックマーク_緑: Echo connected to Pusher!');
    });

// SPA vue
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { createPinia } from 'pinia'
// import { createApp } from 'vue';
// import LearningComponent from './components/LearningComponent.vue';
// import LearningCreate from './components/LearningCreate.vue';
// import LearningFile from './components/LearningFile.vue';
// import LearningList from './components/LearningList.vue';
// import LearningMemorize from './components/LearningMemorize.vue';

//vue setup
// const app = createApp({});// Vue 3 のアプリケーションを生成する関数 createApp() を読み込んでいます。
// app.component('learning-component', LearningComponent);//Vueのシングルファイルコンポーネント（SFC）LearningComponent.vue を読み込んでいます。
//                                                         //このファイルの中には <template>, <script>, <style> の3パートが含まれ、UI部品として扱えます。
// app.component('learning-create', LearningCreate);
// app.component('learning-file', LearningFile);
// app.component('learning-list', LearningList);
// app.component('learning-memorize', LearningMemorize);
// app.mount('#app');//#app の中に Vue アプリケーションを**マウント（描画）**することで、Vueの機能が動作し始めます。(id='app'のhtml要素をターゲット)

window.Alpine = Alpine;
Alpine.start();


const app = createApp(App); // ← App.vue をルートとする Vue インスタンス生成
app.use(createPinia());
app.use(router);            // ← Vue Router を使用するように登録
app.mount('#app');          // ← DOMの id="app" に App.vue を描画（SPAの入口）


