<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{
    public function serve(string $path): BinaryFileResponse
    {
        $base = realpath(storage_path('app/public'));
        $fullPath = realpath(storage_path('app/public/'.ltrim($path, '/')));

        abort_unless(
            $fullPath !== false && $base !== false && str_starts_with($fullPath, $base) && is_file($fullPath),
            404
        );

        return response()->file($fullPath, [
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}
