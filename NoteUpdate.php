<?php
require 'Autoloader.php';
require_once 'functions.php';

use Classes\SessionNotesManager;
use Classes\NoteActions;

session_start();

$notesManager = new SessionNotesManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    NoteActions::handleNoteUpdate($_POST, $notesManager);
    redirect('index.php');
} else {
    echo "Invalid request.";
}
