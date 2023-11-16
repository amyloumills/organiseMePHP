<?php
require_once 'functions.php';
require_once __DIR__ . '/Autoloader.php';

use Classes\NoteActions;
use Classes\SessionNotesManager;

session_start();

$notesManager = new SessionNotesManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    NoteActions::handleNoteCreation($_POST, $notesManager);
    redirect('index.php');
} else {
    echo "Invalid request.";
}
