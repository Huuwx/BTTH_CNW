<?php
include("submit.php");

$filename = "Quiz.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$parsedQuestions = [];
$currentQuestion = [];

foreach ($questions as $line) {
    if (preg_match("/^Câu \d+:/", $line)) {
        if (!empty($currentQuestion)) {
            $parsedQuestions[] = $currentQuestion;
        }
        $currentQuestion = ["question" => $line, "choices" => [], "answer" => ""];
    } elseif (preg_match("/^(A|B|C|D)\./", $line)) {
        $currentQuestion['choices'][] = $line;
    } elseif (strpos($line, "ANSWER:") !== false) {
        $currentQuestion['answer'] = trim(substr($line, strpos($line, ":") + 1));
    }
}
if (!empty($currentQuestion)) {
    $parsedQuestions[] = $currentQuestion;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bài tập trắc nghiệm</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Bài tập trắc nghiệm</h1>
        <form method="POST" action="submit.php">
            <?php foreach ($parsedQuestions as $index => $question): ?>
                <div class="card mb-4">
                    <div class="card-header"><strong><?= $question['question'] ?></strong></div>
                    <div class="card-body">
                        <?php foreach ($question['choices'] as $choice): ?>
                            <?php
                            $choiceValue = substr($choice, 0, 1); // Lấy giá trị: A, B, C, D
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question<?= $index ?>" value="<?= $choiceValue ?>" id="question<?= $index . $choiceValue ?>">
                                <label class="form-check-label" for="question<?= $index . $choiceValue ?>"><?= $choice ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Nộp bài</button>
        </form>
    </div>
</body>
</html>
