<?php
global $conn;
require_once 'connection.php';
require_once 'functions.php';

use Classes\NoteActions;
use Classes\DatabaseNotesManager;

$notesManager = new DatabaseNotesManager($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    NoteActions::handleNoteCreation($_POST, $notesManager);
    redirect('index.php');
} else {
    echo "Invalid request.";
}
