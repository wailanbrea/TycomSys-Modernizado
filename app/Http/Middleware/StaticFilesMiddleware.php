<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaticFilesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();
        
        // Si es un archivo estático de React, servirlo directamente
        if (preg_match('/\.(css|js|png|jpg|jpeg|gif|svg|ico|woff|woff2|ttf|eot|json)$/', $path)) {
            $filePath = public_path("../frontend/build/{$path}");
            
            if (file_exists($filePath)) {
                $mimeType = $this->getMimeType($filePath);
                return response()->file($filePath, [
                    'Content-Type' => $mimeType,
                    'Cache-Control' => 'public, max-age=31536000' // Cache por 1 año
                ]);
            }
        }
        
        return $next($request);
    }
    
    /**
     * Get MIME type for file
     */
    private function getMimeType($file)
    {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        
        $mimeTypes = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'ico' => 'image/x-icon',
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'eot' => 'application/vnd.ms-fontobject',
            'json' => 'application/json',
        ];
        
        return $mimeTypes[$extension] ?? 'application/octet-stream';
    }
}
