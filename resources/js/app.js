import './bootstrap';

// import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import { createApp } from 'vue';
import LearningComponent from './components/LearningComponent.vue';

//vue setup
const app = createApp({});// Vue 3 のアプリケーションを生成する関数 createApp() を読み込んでいます。
app.component('learning-component', LearningComponent);//Vueのシングルファイルコンポーネント（SFC）LearningComponent.vue を読み込んでいます。
                                                        //このファイルの中には <template>, <script>, <style> の3パートが含まれ、UI部品として扱えます。
app.mount('#app');//#app の中に Vue アプリケーションを**マウント（描画）**することで、Vueの機能が動作し始めます。(id='app'のhtml要素をターゲット)
console.log('Vue mounted');

// window.Alpine = Alpine;
// Alpine.start();

//Pusher and Laravel Echo initialization
window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    useTLS:true,
    // withCredentials: true,
});

//Notification Event Trigger - every 5 min
setInterval(() => {
    fetch('/learn/notice', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
        message: 'notice periodically'
        })
    })
    .then(response => {
        if (!response.ok) throw new Error('Network error');
        return response.json();
        })
    .then(data => {
        console.log('送信成功:', data);
    })
    .catch(error => {
        console.error('エラー:', error);
    });
}, 300000); //

//Receive event from pusher
window.Echo.channel('NewWords')
        .listen('.notification', (e) => {
            console.log('受信:', e); //コンソールに受信内容を表示（デバッグ用）
            console.log("Echo object:", window.Echo);

            const notification = document.getElementById('notification');
            const original = document.createElement('p');
            const translated = document.createElement('p');
            original.textContent = e.original;
            translated.textContent = e.translated;
            notification.appendChild(original);
            notification.appendChild(translated);

            setTimeout(() => {
                original.remove();
                translated.remove();
            }, 4000);
        });
