<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Contacts
 *
 * @property int $id
 * @property string $name
 * @property string $cords
 * @property string $addr
 * @property string|null $desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts whereAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts whereCords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Contacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'cords',
        'addr'
    ];
}
