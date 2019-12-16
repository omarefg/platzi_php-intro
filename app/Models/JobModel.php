<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class JobModel extends Model {

    protected $table = 'jobs';

    public function getDurationAsString() {
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;
        if (!$years) {
            return "Job duration: $extraMonths months";
        }
        return "Job duration: $years years, $extraMonths months";
    }
}