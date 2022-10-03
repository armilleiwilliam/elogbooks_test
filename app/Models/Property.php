<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propertyJobs(): HasMany
    {
        return $this->hasMany('App\Models\Job', 'job_id', 'id');
    }

    /**
     * Return an array format of property list: id, name
     * @return array
     */
    static function sanitizePropertiesList(): array
    {
        $allProperties = Property::all()->sortBy("name");
        $listProperty = [];
        if (!empty($allProperties) && count($allProperties) > 0) {
            foreach ($allProperties as $property) {
                $listProperty[] = ["id" => $property->id,
                    "name" => $property->name
                ];
            }
        }
        return $listProperty;
    }
}
