<?php

namespace Ghanem\RemoteImage;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RemoteImageService
{
    public function getImage(string $productName, string $defaultImage): string
    {
        if (config('remote-image.enable') === false) {
            return $defaultImage;
        }

        $cacheDuration = config('remote-image.cache_duration', 3600);

        return Cache::remember("product_image_{$productName}", $cacheDuration, function () use ($productName, $defaultImage) {
            return $this->fetchFromApi($productName) ?? $defaultImage;
        });
    }

    protected function fetchFromApi($productName)
    {
        $apiUrl = config('remote-image.api_url');
        $timeout = config('remote-image.timeout', 3);

        try {
            $response = Http::timeout($timeout)->get($apiUrl, [
                'name' => $productName,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['image'] ?? null;
            }
        } catch (\Exception $e) {
            Log::error("Failed to fetch image for {$productName}: " . $e->getMessage());
        }

        return null;
    }
}
