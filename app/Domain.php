<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Domain
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Domain newModelQuery()
 * @method static Builder|Domain newQuery()
 * @method static Builder|Domain query()
 * @method static Builder|Domain whereCreatedAt($value)
 * @method static Builder|Domain whereId($value)
 * @method static Builder|Domain whereName($value)
 * @method static Builder|Domain whereSlug($value)
 * @method static Builder|Domain whereDescription($value)
 * @method static Builder|Domain whereUpdatedAt($value)
 * @mixin Model
 * @property-read Collection|Invention[] $inventions
 */
class Domain extends BaseModel
{
    public function inventions()
    {
        return $this->hasMany(Invention::class);
    }
}
