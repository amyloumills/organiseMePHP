<?php
require_once 'Classes/Note.php';
require_once 'Classes/SessionNotesManager.php';
require_once 'Classes/NoteActions.php';
require_once 'functions.php';

session_start();

$notesManager = new SessionNotesManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    NoteActions::handleNoteUpdate($_POST, $notesManager);
    redirect('index.php');
} else {
    echo "Invalid request.";
}
