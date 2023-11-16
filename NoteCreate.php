<?php
require_once 'functions.php';
require_once 'Autoloader.php';

use Classes\SessionNotesManager;
use Classes\NoteActions;

session_start();

$notesManager = new SessionNotesManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    NoteActions::handleNoteCreation($_POST, $notesManager);
    redirect('index.php');
}
