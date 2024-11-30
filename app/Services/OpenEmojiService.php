<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenEmojiService 
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct(string $baseUrl, string $apiKey)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
    }

    public function fetchAllEmoji(): array
    {
        $response = Http::get("{$this->baseUrl}/emojis", [
            'apiKey' => $this->apiKey,
        ]);

        if ($response->successful())
        {
            return $response->json();
        }
        return [];
    }

    public function searchEmoji(string $query): array
    {
        $response = Http::get("{$this->baseUrl}/emojis", [
            'api_key' => $this->apiKey,
            'search' => $query,
        ]);

        if ($response->successful()) {
            return $response->json();
        }
        return [];
    }
}

