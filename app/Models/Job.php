<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Job extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'summary',
        'description',
        'property_id',
        'user_id',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo('App\Models\Property', 'property_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getPropertyNameAttribute(): String
    {
        return $this->property->name;
    }

    /**
     * I sanitize properties to be process by front end code
     * @return Array
     */
    static function sanitizeJobList(): Array
    {
        $allJobs = self::all()->sortByDesc("created_at");
        $listJobs = [];
        if(!empty($allJobs) && count($allJobs) > 0){
            foreach ($allJobs as $job) {
                $listJobs[] = ["summary" => $job->summary,
                    "description" => $job->description,
                    "status" => $job->status,
                    "property" => $job->property->name,
                    "created_by" => $job->user->name,
                    "created_at" => $job->created_at->format("d/m/Y h:i:s")];
            }
        }

        return $listJobs;
    }
}
