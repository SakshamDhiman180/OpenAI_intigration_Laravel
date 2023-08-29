<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class openaiController extends Controller
{
    //

    public function response(Request $prompt){
       
        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $prompt->userInput,
            'max_tokens' => 1000,
        ]);
       
        return $result['choices'][0]['text'];
    }
}
