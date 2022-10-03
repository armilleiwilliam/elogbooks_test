<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\Paginator;


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
     * I sanitize jobs list to be processed by React front end code
     * @return Array
     */
    static function sanitizeJobList($page)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $allJobs = self::orderByDesc('created_at')->paginate(10);
        $listJobs = [];
        $pageInfo = null;
        if(!empty($allJobs) && method_exists($allJobs, "items")){
            $jobsList = $allJobs;
            foreach ($jobsList->items() as $job) {
                $listJobs[] = [
                    "id" => $job->id,
                    "summary" => $job->summary,
                    "description" => $job->description,
                    "status" => $job->status,
                    "property" => $job->property->name,
                    "created_by" => $job->user->name,
                    "created_at" => $job->created_at->format("d/m/Y h:i:s")];
            }

            $pageInfo = [
                "current_page" => $allJobs->currentPage(),
                "last_page" => $allJobs->lastPage(),
                "per_page" => $allJobs->perPage(),
                "total" => $allJobs->total(),
                "jobs" => $listJobs
            ];
        }

        return $pageInfo;
    }
}
