<?php
require __DIR__ . '/../Database.php';
$database = new Database;

if (isset($_POST['form-excercies'], $_POST['u_id'], $_POST['name'], $_POST['session'], $_POST['duration'], $_POST['pattern'], $_POST['started'], $_POST['ended'], $_POST['info'])) {
    
    $userId = $_POST['u_id'];
    $name = $_POST['name'];
    $session = $_POST['session'];
    $duration = $_POST['duration'];
    $pattern = $_POST['pattern'];
    $startedAt = $_POST['started'];
    $endedAt = $_POST['ended'];
    $info = $_POST['info'];

    $database->createExcerciseRow($userId, $name, $session, $duration, $pattern, $startedAt, $endedAt, $info);
}

if (isset($_POST['form-notes'], $_POST['u_id'], $_POST['note'])) {
    $userId = $_POST['u_id'];
    $note = $_POST['note'];

    $database->createNote($userId, $note);
}

if (isset($_GET['complete'], $_GET['note_id'])) {
    $noteId = $_GET['note_id'];
    $completed = $_GET['complete'];

    $database->markNoteComplete($noteId, $completed);
}

if (isset($_GET['deleted'], $_GET['note_id'])) {
    $noteId = $_GET['note_id'];
    $completed = $_GET['complete'];

    $database->deleteNote($noteId);
}

header("Location: /dashboard.php");