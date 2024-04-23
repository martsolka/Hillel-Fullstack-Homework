<?php

namespace App\Models;

use App\Enums\PollTypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollType extends Model
{
    use HasFactory;

    const DEFAULT_STATUS = PollTypeStatus::DRAFT->value;
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'status'];
    protected $attributes = ['status' => self::DEFAULT_STATUS];
    protected $casts = ['status' => PollTypeStatus::class];
}
