<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'name', 'email', 'phone', 'city', 'zip',
        'interests', 'message', 'data', 'status', 'source',
        'ip_address', 'user_agent', 'contacted_at',
    ];

    protected $casts = [
        'interests'    => 'array',
        'data'         => 'array',
        'contacted_at' => 'datetime',
    ];

    public const TYPES = [
        'quote'         => 'Quote Request',
        'questionnaire' => 'Questionnaire',
        'consultation'  => 'Consultation',
        'callback'      => 'Callback Request',
        'contact'       => 'Contact Message',
    ];

    public const STATUSES = ['new', 'contacted', 'quoted', 'won', 'closed'];

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? ucfirst($this->type);
    }

    public function scopeStatus($query, ?string $status)
    {
        return $status ? $query->where('status', $status) : $query;
    }

    public function scopeType($query, ?string $type)
    {
        return $type ? $query->where('type', $type) : $query;
    }
}
