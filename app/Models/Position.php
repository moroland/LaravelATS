<?php

namespace App\Models;

use App\Policies\PositionPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Gate;

class Position extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'max_applicants',
    ];

    /**
     * @throws \Exception
     */
    public function apply(User $user) {


        if ($user->cannot('apply', $this)) {
            $policy = new PositionPolicy();
            $response = $policy->apply($user, $this);
            throw new Exception('You cannot apply for this position. ' . $response->message());
        }


        $application = new JobApplication();
        $application->position_id = $this->id;
        $application->applicant_user_id = $user->id;
        $application->date = now();
        $application->status = 'pending';
        $application->save();
        return TRUE;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'id' => 'integer',
            'max_applicants' => 'integer',
        ];
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
}
