<?php

function printElements($elements) {
    $totalElements = "";
    foreach ($elements as $element) {
        $totalElements .= "
            <li class=\"work-position\">
            <h5>".$element->title."</h5>
            <p>".$element->description."</p>
            <p>".$element->getDurationAsString()."</p>
            <strong>Achievements:</strong>
            <ul>
                <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
                <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
                <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
            </ul>
            </li>
        ";
    }
    echo $totalElements;
}