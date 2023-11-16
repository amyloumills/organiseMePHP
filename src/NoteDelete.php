<?php
require 'Autoloader.php';
require_once 'functions.php';

use Classes\NoteActions;
use Classes\SessionNotesManager;

session_start();

$notesManager = new SessionNotesManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    NoteActions::handleNoteDelete($_POST, $notesManager);
    redirect('index.php');
} else {
    echo "Invalid request.";
}
