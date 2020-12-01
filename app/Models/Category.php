<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $cover
 * @property int $serial_number_web
 * @property int $serial_number_mob
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSerialNumberMob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSerialNumberWeb($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $guarded=[];
    public $timestamps = false;
}
