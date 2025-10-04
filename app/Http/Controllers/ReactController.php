<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReactController extends Controller
{
    /**
     * Serve the React application
     */
    public function index()
    {
        $reactAppPath = public_path('../frontend/build/index.html');

        if (file_exists($reactAppPath)) {
            $content = file_get_contents($reactAppPath);

            // Asegurar que las rutas de los assets sean absolutas
            $content = str_replace('/static/', '/static/', $content);

            // Agregar información del usuario autenticado con roles y permisos
            $userData = null;
            if (auth()->check()) {
                $user = auth()->user();
                $userData = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => $user->roles->map(function($role) {
                        return [
                            'id' => $role->id,
                            'name' => $role->name,
                            'display_name' => $role->display_name,
                            'permissions' => $role->permissions->map(function($permission) {
                                return [
                                    'id' => $permission->id,
                                    'name' => $permission->name,
                                    'display_name' => $permission->display_name
                                ];
                            })
                        ];
                    }),
                    'permissions' => $user->getAllPermissions()->map(function($permission) {
                        return [
                            'id' => $permission->id,
                            'name' => $permission->name,
                            'display_name' => $permission->display_name
                        ];
                    }),
                    'is_admin' => $user->hasRole('admin'),
                    'is_tecnico' => $user->hasRole('tecnico')
                ];
            }

            // Agregar token CSRF
            $csrfToken = csrf_token();
            $csrfScript = '<meta name="csrf-token" content="' . $csrfToken . '">';
            $content = str_replace('</head>', $csrfScript . '</head>', $content);

            if ($userData) {
                $userScript = '<script>window.user = ' . json_encode($userData) . ';</script>';
                $content = str_replace('</head>', $userScript . '</head>', $content);
            }

            return response($content, 200, [
                'Content-Type' => 'text/html; charset=utf-8'
            ]);
        }

        return response()->view('react-app', [], 200);
    }
    
    /**
     * Serve React static assets
     */
    public function assets($path)
    {
        $assetPath = public_path("../frontend/build/static/{$path}");
        
        if (file_exists($assetPath)) {
            $mimeType = $this->getMimeType($assetPath);
            return response()->file($assetPath, ['Content-Type' => $mimeType]);
        }
        
        return response('Asset not found', 404);
    }
    
    /**
     * Serve other static files (images, fonts, etc.)
     */
    public function staticFiles($path)
    {
        $assetPath = public_path("../frontend/build/{$path}");
        
        if (file_exists($assetPath)) {
            $mimeType = $this->getMimeType($assetPath);
            return response()->file($assetPath, ['Content-Type' => $mimeType]);
        }
        
        return response('File not found', 404);
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
