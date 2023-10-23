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

    // Validate and process the updated data
    $updatedNote = new Note($noteId, $newTitle, $newContent);
    // die(var_dump($updatedNote));
    $notesManager->update($updatedNote);
    // Redirect back to index.php after updating the note
    redirect('index.php');
} else {
    // Handle invalid form submission
    echo "Invalid request.";
}
