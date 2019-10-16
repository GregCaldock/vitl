<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait HasUuid
{
    public static function bootHasUuid(): void
    {
        self::creating(static function (Model $model): void {
            if (!isset($model->id) || Uuid::isValid($model->id) === false) {
                $model->id = (string) Uuid::uuid4();
            }
        });
    }
}
