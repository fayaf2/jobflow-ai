<?php
$filePath = 'jobs.txt';

$jobs = [];

if (file_exists($filePath)) {
    $file = fopen($filePath, 'r');
    while (($line = fgets($file)) !== false) {
        list($jobTitle, $jobDetails, $applyLink) = explode(',', trim($line));
        $jobs[strtolower($jobTitle)] = [
            'title' => $jobTitle,
            'details' => $jobDetails,
            'applyLink' => $applyLink
        ];
    }
    fclose($file);
}

header('Content-Type: application/json');
echo json_encode($jobs);
?>
