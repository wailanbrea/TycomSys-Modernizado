<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SystemSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'is_public',
        'is_required',
        'validation_rules',
        'options',
        'sort_order',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'is_required' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Obtener el valor de una configuración
     */
    public static function get($key, $default = null)
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            $setting = self::where('key', $key)->first();
            
            if (!$setting) {
                return $default;
            }

            return self::castValue($setting->value, $setting->type);
        });
    }

    /**
     * Establecer el valor de una configuración
     */
    public static function set($key, $value, $type = 'string', $label = null, $group = 'general')
    {
        $setting = self::firstOrNew(['key' => $key]);
        $setting->value = $value;
        $setting->type = $type;
        $setting->label = $label ?? ucfirst(str_replace('_', ' ', $key));
        $setting->group = $group;
        $setting->save();

        // Limpiar cache
        Cache::forget("setting.{$key}");

        return $setting;
    }

    /**
     * Obtener todas las configuraciones de un grupo
     */
    public static function getGroup($group)
    {
        return Cache::remember("settings.group.{$group}", 3600, function () use ($group) {
            return self::where('group', $group)
                ->orderBy('sort_order')
                ->get()
                ->mapWithKeys(function ($setting) {
                    return [$setting->key => self::castValue($setting->value, $setting->type)];
                });
        });
    }

    /**
     * Obtener configuraciones públicas
     */
    public static function getPublic()
    {
        return Cache::remember('settings.public', 3600, function () {
            return self::where('is_public', true)
                ->orderBy('group')
                ->orderBy('sort_order')
                ->get()
                ->mapWithKeys(function ($setting) {
                    return [$setting->key => self::castValue($setting->value, $setting->type)];
                });
        });
    }

    /**
     * Convertir valor según el tipo
     */
    private static function castValue($value, $type)
    {
        if ($value === null) {
            return null;
        }

        switch ($type) {
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case 'integer':
                return (int) $value;
            case 'float':
                return (float) $value;
            case 'json':
                return json_decode($value, true);
            case 'array':
                return is_string($value) ? explode(',', $value) : $value;
            default:
                return $value;
        }
    }

    /**
     * Limpiar cache de configuraciones
     */
    public static function clearCache()
    {
        Cache::forget('settings.public');
        
        // Limpiar cache de grupos
        $groups = self::distinct()->pluck('group');
        foreach ($groups as $group) {
            Cache::forget("settings.group.{$group}");
        }
        
        // Limpiar cache individual
        $keys = self::pluck('key');
        foreach ($keys as $key) {
            Cache::forget("setting.{$key}");
        }
    }

    /**
     * Scope para configuraciones públicas
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    /**
     * Scope para un grupo específico
     */
    public function scopeGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    /**
     * Scope ordenado
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('group')->orderBy('sort_order');
    }

    /**
     * Obtener opciones para campos select
     */
    public function getOptionsArray()
    {
        if (empty($this->options)) {
            return [];
        }

        if ($this->type === 'json') {
            return json_decode($this->options, true);
        }

        return array_map('trim', explode(',', $this->options));
    }

    /**
     * Obtener reglas de validación
     */
    public function getValidationRulesArray()
    {
        if (empty($this->validation_rules)) {
            return [];
        }

        return array_map('trim', explode('|', $this->validation_rules));
    }

    /**
     * Verificar si es un campo requerido
     */
    public function isRequired()
    {
        return $this->is_required;
    }

    /**
     * Verificar si es público
     */
    public function isPublic()
    {
        return $this->is_public;
    }

    /**
     * Obtener el valor convertido
     */
    public function getConvertedValue()
    {
        return self::castValue($this->value, $this->type);
    }
}