<?php
use App\Models\{ Project };

$projects = Project::all();

function createProject($title, $description) {
    $project = new Project();
    $project->title = $title;
    $project->description = $description;
    $project->visible = 1;
    $project->months = 16;
    $project->save();
}
