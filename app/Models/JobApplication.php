<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JobApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position_id',
        'applicant_user_id',
        'date',
        'status',
    ];

    public function accept(): bool {
        $this->status = 'accepted';
        $this->save();

        $this->applicant_user->notify(
            Notification::make()
                ->title('Your application to ' . $this->position->title . ' has been accepted.')
                ->toDatabase(),
        );

        return true;
    }

    public function reject(): bool {
        $this->status = 'rejected';
        $this->save();
        $this->applicant_user->notify(
            Notification::make()
                ->title('Your application to ' . $this->position->title . ' has been rejected.')
                ->toDatabase(),
        );

        return true;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'position_id' => 'integer',
            'applicant_user_id' => 'integer',
            'date' => 'datetime',
        ];
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function applicant_user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
