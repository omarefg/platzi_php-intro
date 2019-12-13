<?php
use App\Models\{ Job };

$jobs = Job::all();

function createJob($title, $description) {
    $job = new Job();
    $job->title = $title;
    $job->description = $description;
    $job->visible = 1;
    $job->months = 16;
    $job->save();
}
