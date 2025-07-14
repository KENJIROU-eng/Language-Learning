<!-- step1 -->
<!-- <template>
    <div>
        <h2>Hello Vue!</h2>
    </div>
</template>

<script>
    console.log('✅ LearningComponent loaded')
</script> -->

<!-- step2 -->
<template>
    <div style="border: 2px solid green; padding: 20px;">
        <h2>📘 学習リスト</h2>
        <div class="flex">
            <ul>
                <li v-for="word in words" :key="word.id">
                {{ word.originalText }}
                </li>
            </ul>
            <ul>
                <li v-for="word in words" :key="word.id">
                {{ word.translatedText }}
                </li>
            </ul>
        </div>
        <p v-if="error" class="text-red-500 mt-2">{{ error }}</p>
    </div>
</template>

<script setup>

// ref：Vue のリアクティブ変数（反応する変数）を作成するための関数
// onMounted：Vueコンポーネントが画面に「マウントされたとき」に実行する処理を定義する
import { ref, onMounted } from 'vue';
import axios from '../bootstrap.js';

// lessons は空の配列として初期化
// ref によってリアクティブな状態を持つ
// → この変数の中身が変わると、Vue が DOM を自動で更新してくれる
const words = ref([]);
const error = ref('');

// Vueコンポーネントが画面に表示された(マウント)直後に、API を呼び出す
// fetch('/api/lessons') により、Laravel の API エンドポイントからデータを取得
// await response.json() でレスポンスを JSON に変換
// lessons.value に代入することで、リストに反映される
onMounted(async () => {
try {
    const response = await axios.get('/api/vue/test');
    words.value = response.wordList;
} catch (error) {
    console.error('❌ API fetch failed:', error);
    error.value = 'ワード情報の取得に失敗しました'
}
});
</script>
