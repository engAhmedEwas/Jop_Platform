<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Resume;
use App\Models\JobVacancy;

class JobApplication extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUuids, softDeletes;

    protected $table = "job_applications"; // the table name is burler in db

    protected $keyType = "string";
    public $incrementing = false;

        protected $fillable = [
        'status',
        'aiGeneratedScore',
        'aiGeneratedFeedback',
        'jobVacancy_id',
        'resumeId',
        'user_id',
    ];

    protected $dates =[
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    public function resume(){
        return $this->belongsTo(Resume::class, 'resumeId', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jobVacancy(){
        return $this->belongsTo(JobVacancy::class, 'jobVacancy_id', 'id');
    }
}
