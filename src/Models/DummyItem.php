<?php

namespace Bithoven\Dummy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DummyItem extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Valid status values
     * Must match database ENUM definition
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    /**
     * Valid priority values
     * Must match database ENUM definition
     */
    public const PRIORITY_LOW = 'low';
    public const PRIORITY_NORMAL = 'normal';
    public const PRIORITY_HIGH = 'high';
    public const PRIORITY_CRITICAL = 'critical';

    /**
     * Valid category values
     */
    public const CATEGORY_GENERAL = 'general';
    public const CATEGORY_IMPORTANT = 'important';
    public const CATEGORY_ARCHIVED = 'archived';

    protected $fillable = [
        'name',
        'category',
        'priority',
        'description',
        'status',
        'order',
        'color',
        'icon',
        'is_featured',
        'notes',
        'tags',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_featured' => 'boolean',
        'tags' => 'array',
    ];

    protected $attributes = [
        'status' => self::STATUS_PENDING,
        'priority' => self::PRIORITY_NORMAL,
        'category' => self::CATEGORY_GENERAL,
        'order' => 0,
        'is_featured' => false,
        'color' => '#000000',
    ];

    /**
     * Get all valid status values
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_IN_PROGRESS,
            self::STATUS_COMPLETED,
            self::STATUS_CANCELLED,
        ];
    }

    /**
     * Get all valid priority values
     */
    public static function getPriorities(): array
    {
        return [
            self::PRIORITY_LOW,
            self::PRIORITY_NORMAL,
            self::PRIORITY_HIGH,
            self::PRIORITY_CRITICAL,
        ];
    }

    /**
     * Get all valid category values
     */
    public static function getCategories(): array
    {
        return [
            self::CATEGORY_GENERAL,
            self::CATEGORY_IMPORTANT,
            self::CATEGORY_ARCHIVED,
        ];
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'badge-light-warning',
            self::STATUS_IN_PROGRESS => 'badge-light-primary',
            self::STATUS_COMPLETED => 'badge-light-success',
            self::STATUS_CANCELLED => 'badge-light-danger',
            default => 'badge-light-secondary',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Pending',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
            default => 'Unknown',
        };
    }

    /**
     * Get priority badge class
     */
    public function getPriorityBadgeClass(): string
    {
        return match($this->priority) {
            self::PRIORITY_LOW => 'badge-light-info',
            self::PRIORITY_NORMAL => 'badge-light-primary',
            self::PRIORITY_HIGH => 'badge-light-warning',
            self::PRIORITY_CRITICAL => 'badge-light-danger',
            default => 'badge-light-secondary',
        };
    }
}
