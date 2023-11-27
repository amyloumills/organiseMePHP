<?php
global $conn;
require 'Autoloader.php';
require_once 'functions.php';
require_once 'connection.php';


use Classes\NoteActions;
use Classes\DatabaseNotesManager;

session_start();

$notesManager = new DatabaseNotesManager($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['note_id'])) {
    $noteId = $_POST['note_id'];
    NoteActions::handleNoteDelete($noteId, $notesManager);
    redirect('index.php');
} else {
    echo "Invalid request.";
}
