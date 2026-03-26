<?php

namespace App\Http\Controllers;

use App\Models\ContentPageRoute;
use App\Models\SiteFile;
use Illuminate\Http\Response;

class StaticContentController extends Controller
{
    public function show(?string $path = null): Response
    {
        $requestPath = $this->normalizePath($path);

        $route = ContentPageRoute::query()
            ->with('page')
            ->where('path', $requestPath)
            ->first();

        if (! $route?->page) {
            abort(404);
        }

        return response()
            ->view('content.raw', ['page' => $route->page])
            ->header('Content-Type', 'text/html; charset=UTF-8');
    }

    public function robots(): Response
    {
        $robots = SiteFile::query()->where('path', '/robots.txt')->first();

        if (! $robots) {
            abort(404);
        }

        return response($robots->content)
            ->header('Content-Type', $robots->mime_type.'; charset=UTF-8');
    }

    private function normalizePath(?string $path): string
    {
        $normalized = '/'.trim((string) $path, '/');

        return $normalized === '/' ? '/' : rtrim($normalized, '/');
    }
}
