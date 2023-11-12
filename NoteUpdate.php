<?php
require_once 'Classes/Note.php';
require_once 'Classes/SessionNotesManager.php';
require_once 'functions.php';

session_start();

$notesManager = new SessionNotesManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $noteId = $_POST['note_id'];
    $newTitle = $_POST['title'];
    $newContent = $_POST['content'];

    $updatedNote = new Note($noteId, $newTitle, $newContent);
    $notesManager->update($updatedNote);

    redirect('index.php');
} else {
    echo "Invalid request.";
}
