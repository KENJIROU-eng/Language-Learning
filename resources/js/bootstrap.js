import axios from 'axios';
window.axios = axios;

axios.defaults.withCredentials = true; // Cookieを毎回送信
axios.withXSRFToken = true; // Laravel Sanctum用（Axios v1.6+）
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default axios;
