<?php
global $conn;
require_once 'functions.php';
require_once 'connection.php';

use Classes\NoteActions;
use Classes\DatabaseNotesManager;

$notesManager = new DatabaseNotesManager($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['note_id'])) {
    NoteActions::handleNoteUpdate($_POST, $notesManager);
    redirect('index.php');
} else {
    echo "Invalid request.";
}
