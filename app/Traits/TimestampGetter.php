<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait TimeStampGetter{
    protected function createdAt(): Attribute{
        return Attribute::make(
            get: fn (string $date) => Carbon::parse($date)->format('d-m-Y H:i:s'),
        );
    }
    protected function updatedAt(): Attribute{
        return Attribute::make(
            get: fn (string $date) => Carbon::parse($date)->format('d-m-Y H:i:s'),
        );
    }

}