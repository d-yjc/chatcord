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
        \Log::info('OpenEmojiService initialized with API key: ' . $this->apiKey);
    }
    

    public function fetchAllEmoji(): array
    {
        $response = Http::get("{$this->baseUrl}/emojis", [
            'access_key' => $this->apiKey,
        ]);

        if ($response->successful()) {
            $emojis = $response->json();

            foreach ($emojis as &$emoji) {
                $emoji['character'] = $this->decodeUnicode($emoji['character']);
            }
            return $emojis;
        }
        return [];
    }

    public function searchEmojis(string $query): array
    {
        $response = Http::get("{$this->baseUrl}/emojis", [
            'access_key' => $this->apiKey,
            'search'     => $query,
        ]);
    
        \Log::info('API response status: ' . $response->status());
    
        if ($response->successful()) {
            $emojis = $response->json();

            //This occurs when the API doesn't find any results
            if (!is_array($emojis))
            {
                return [];
            }
    
            \Log::info('API returned ' . count($emojis) . ' emojis.');
    
            foreach ($emojis as &$emoji) {
                if (is_array($emoji) && isset($emoji['character'])) {
                    $emoji['character'] = $this->decodeUnicode($emoji['character']);
                } 
            }
            return $emojis;
        }
        return [];
    }

    private function decodeUnicode($string)
    {
        return json_decode('"' . $string . '"');
    }
}
