<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class JobApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'position_id',
        'position_title',
        'cover_letter',
        'resume_path',
        'user_id',
        'status',
        'notes',
        'reviewed_at',
        'reviewed_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'reviewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should have default values.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'status' => 'pending',
    ];

    /**
     * Get the user that submitted the application.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the admin who reviewed the application.
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get the job posting that this application is for.
     */
    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class, 'position_id');
    }

    /**
     * Get the resume URL.
     */
    public function getResumeUrlAttribute()
    {
        if ($this->resume_path) {
            return Storage::url($this->resume_path);
        }
        return null;
    }

    /**
     * Get the resume filename.
     */
    public function getResumeFilenameAttribute()
    {
        if ($this->resume_path) {
            return basename($this->resume_path);
        }
        return null;
    }

    /**
     * Get the status badge class.
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'reviewed' => 'bg-blue-100 text-blue-800',
            'shortlisted' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'hired' => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Pending Review',
            'reviewed' => 'Reviewed',
            'shortlisted' => 'Shortlisted',
            'rejected' => 'Not Selected',
            'hired' => 'Hired',
            default => ucfirst($this->status),
        };
    }

    /**
     * Scope a query to only include pending applications.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include reviewed applications.
     */
    public function scopeReviewed($query)
    {
        return $query->where('status', 'reviewed');
    }

    /**
     * Scope a query to only include shortlisted applications.
     */
    public function scopeShortlisted($query)
    {
        return $query->where('status', 'shortlisted');
    }

    /**
     * Scope a query to only include rejected applications.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope a query to only include hired applications.
     */
    public function scopeHired($query)
    {
        return $query->where('status', 'hired');
    }

    /**
     * Scope a query to filter by position.
     */
    public function scopeForPosition($query, $positionId)
    {
        return $query->where('position_id', $positionId);
    }

    /**
     * Mark the application as reviewed.
     */
    public function markAsReviewed($notes = null)
    {
        $this->status = 'reviewed';
        $this->notes = $notes;
        $this->reviewed_at = now();
        $this->reviewed_by = auth()->id();
        $this->save();
    }

    /**
     * Mark the application as shortlisted.
     */
    public function markAsShortlisted($notes = null)
    {
        $this->status = 'shortlisted';
        $this->notes = $notes;
        $this->reviewed_at = now();
        $this->reviewed_by = auth()->id();
        $this->save();
    }

    /**
     * Mark the application as rejected.
     */
    public function markAsRejected($notes = null)
    {
        $this->status = 'rejected';
        $this->notes = $notes;
        $this->reviewed_at = now();
        $this->reviewed_by = auth()->id();
        $this->save();
    }

    /**
     * Mark the application as hired.
     */
    public function markAsHired($notes = null)
    {
        $this->status = 'hired';
        $this->notes = $notes;
        $this->reviewed_at = now();
        $this->reviewed_by = auth()->id();
        $this->save();
    }

    /**
     * Delete the resume file when application is deleted.
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($application) {
            // Delete the resume file when application is deleted
            if ($application->resume_path) {
                Storage::disk('public')->delete($application->resume_path);
            }
        });
    }
}
