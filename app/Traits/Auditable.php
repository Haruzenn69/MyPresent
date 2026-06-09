<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    protected static function bootAuditable()
    {
        static::created(function ($model) {
            static::logAudit('created', $model, null, $model->toArray());
        });

        static::updated(function ($model) {
            $changes = $model->getChanges();
            $old = [];
            foreach ($changes as $key => $value) {
                if (in_array($key, ['updated_at', 'created_at'])) continue;
                $old[$key] = $model->getOriginal($key);
            }
            if (!empty($changes)) {
                static::logAudit('updated', $model, $old, $changes);
            }
        });

        static::deleted(function ($model) {
            static::logAudit('deleted', $model, $model->toArray(), null);
        });
    }

    protected static function logAudit($action, $model, $oldValues, $newValues)
    {
        if (!Auth::check()) return;

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'description' => static::generateDescription($action, $model),
            'old_values' => $oldValues ? json_encode($oldValues) : null,
            'new_values' => $newValues ? json_encode($newValues) : null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    protected static function generateDescription($action, $model)
    {
        $name = method_exists($model, 'getName') ? $model->getName() : ($model->nama ?? $model->name ?? '#' . $model->id);
        return strtoupper($action) . ' ' . class_basename($model) . ': ' . $name;
    }
}
