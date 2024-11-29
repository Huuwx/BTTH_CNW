<?php
$filename = "Quiz.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$parsedQuestions = [];
$currentQuestion = [];

foreach ($questions as $line) {
    if (preg_match("/^Câu \d+:/", $line)) {
        if (!empty($currentQuestion)) {
            $parsedQuestions[] = $currentQuestion;
        }
        $currentQuestion = ["answer" => ""];
    } elseif (strpos($line, "ANSWER:") !== false) {
        $currentQuestion['answer'] = trim(substr($line, strpos($line, ":") + 1));
    }
}
if (!empty($currentQuestion)) {
    $parsedQuestions[] = $currentQuestion;
}

$score = 0;
$totalQuestions = count($parsedQuestions);

foreach ($_POST as $key => $userAnswer) {
    $questionIndex = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
    if ($parsedQuestions[$questionIndex]['answer'] === $userAnswer) {
        $score++;
    }
}

// Hiển thị kết quả
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Kết quả</title>
</head>
<body>
    <div class="container mt-5 text-center">
        <h1>Kết quả</h1>
        <div class="alert alert-success">
            Bạn trả lời đúng <strong><?= $score ?></strong>/<?= $totalQuestions ?> câu.
        </div>
        <a href="index.php" class="btn btn-primary">Làm lại</a>
    </div>
</body>
</html>
