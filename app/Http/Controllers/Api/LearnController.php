<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Learn;

class LearnController extends Controller
{

    private $learn;

    public function __construct(Learn $learn) {
        $this->learn = $learn;
    }

    public function vueTest() {
        return response()->json([
            'wordList' => $this->learn->all()
        ]);
    }
}
