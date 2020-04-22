<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Invention
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property int $domain_id
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
 * @method static Builder|Domain whereDomainId($value)
 * @method static Builder|Domain whereUpdatedAt($value)
 * @mixin Model
 * @property-read Domain $domain
 */
class Invention extends BaseModel
{
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
