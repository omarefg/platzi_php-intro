<?php

namespace App\Models;

class BaseElement {
    public $title;
    public $description;
    public $isVisible = true;
    public $months;

    public function __construct($title, $description, $months) {
        $this->setTitle($title);
        $this->description = $description;
        $this->months = $months;
    }

    public function setTitle($title) {
        if (!$title) {
            $this->title = 'N/A';
        } else {
            $this->title = $title;
        }
    }

    public function getTitle() {
      return $this->title;
    }

    public function getDurationAsString() {
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;
        if (!$years) {
            return "$extraMonths months";
        }
        return "$years years, $extraMonths months";
    }
}