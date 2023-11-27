<?php
global $conn;
require_once 'connection.php';
require_once 'functions.php';
require_once __DIR__ . '/Autoloader.php';

use Classes\NoteActions;
use Classes\DatabaseNotesManager;

session_start();

$notesManager = new DatabaseNotesManager($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    NoteActions::handleNoteCreation($_POST, $notesManager);
    redirect('index.php');
} else {
    echo "Invalid request.";
}
