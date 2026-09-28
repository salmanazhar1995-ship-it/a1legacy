<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendChatMessageRequest;
use App\Services\ChatAgentService;
use Illuminate\Http\JsonResponse;

class ChatAgentController extends Controller
{
    public function __invoke(SendChatMessageRequest $request, ChatAgentService $chatAgent): JsonResponse
    {
        $reply = $chatAgent->replyTo($request->string('message')->trim()->toString());

        return response()->json($reply);
    }
}
