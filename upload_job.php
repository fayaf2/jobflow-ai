<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobTitle = trim($_POST['jobTitle']);
    $jobDetails = trim($_POST['jobDetails']);
    $applyLink = trim($_POST['applyLink']);

    if ($jobTitle && $jobDetails && $applyLink) {
        $jobData = $jobTitle . ',' . $jobDetails . ',' . $applyLink . PHP_EOL;
        file_put_contents('jobs.txt', $jobData, FILE_APPEND);
        echo "Job uploaded successfully!";
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}
?>
