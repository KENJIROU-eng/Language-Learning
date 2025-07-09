<?php

namespace App\Http\Controllers;

use App\Models\Learn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Events\NewWordNotification;

class LearnController extends Controller
{
    private $learn;

    public function __construct(Learn $learn) {
        $this->learn = $learn;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($fileName)
    {
        $all_words = $this->learn->whereDate('created_at', $fileName)->get();

        return view('learning.list')
            ->with('all_words', $all_words);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Learning.create');
    }

    public function translate(Request $request)
    {
        $request->validate([
            'words' => 'required|min:1|max:200',
        ]);
        $text = $request->words;

        $response = Http::asForm()->post('https://api-free.deepl.com/v2/translate', [
        'auth_key' => env('DEEPL_API_KEY'),
        'text' => $text,
        'target_lang' => 'JA',
        // 'source_lang' => 'EN', // 任意
    ]);

    $json = $response->json();

    $this->learn->originalText = $text;
    $this->learn->translatedText = $json['translations'][0]['text'];
    $this->learn->save();

    return response()->json([
        'translated' => $json['translations'][0]['text'] ?? '翻訳失敗',
        'storedOriginal' => $this->learn->originalText ?? '保存失敗',
        'storedTranslated' => $this->learn->translatedText ?? '保存失敗',
    ]);
    }

    public function fileList() {
        $all_lists = $this->learn->all();

        $fileNames = [];
        foreach ($all_lists as $list) {
            $date = $list->created_at->format('Y-m-d');
            if (!in_array($date, $fileNames)) {
                $fileNames[] = $date;
            }
        }
        $fileCount = count($fileNames);
        $fileDetail = [];
        for ($i = 0; $i < $fileCount; $i++) {
            $count = 0;
            foreach ($all_lists as $list) {
                $date = $list->created_at->format('Y-m-d');
                if ($date == $fileNames[$i]) {
                    $count++;
                }
            }
            $fileDetail[] = [$count, $fileNames[$i]];
        }

        return view('Learning.file-list')
            ->with('fileDetail', $fileDetail);
    }

    public function memorize($fileName) {
        $all_words = $this->learn->whereDate('created_at', $fileName)->get();

        $wordSet = [];
        foreach ($all_words as $word) {
            $wordSet[] = [$word->originalText, $word->translatedText];
        }

        return view('Learning.memorize')
            ->with('fileName', $fileName)
            ->with('wordSet', $wordSet);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Learn $learn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Learn $learn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'translatedText' => 'required|min:1|max:200',
        ]);
        $text = $request->translatedText;
        $learn = $this->learn->orderBy('created_at', 'desc')->first();
        $learn->translatedText = $text;
        $learn->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Learn $learn)
    {
        //
    }

    public function notice() {
        $learnRandom = $this->learn->inRandomOrder()->first();

        broadcast(new NewWordNotification($learnRandom));
        return response()->json(['status' => 'broadcast sent']);
    }
}
