<?php
require_once 'Classes/Note.php';
require_once 'Classes/SessionNotesManager.php';
require_once 'functions.php';

session_start();

$notesManager = new SessionNotesManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['note_id'])) {
        $noteId = $_POST['note_id'];
        $notesManager->delete($noteId);
    }
}


// Redirect back to index.php
redirect('index.php');
exit();
