<?php
require 'Autoloader.php';
require_once 'functions.php';

use Classes\SessionNotesManager;


session_start();

$notesManager = new SessionNotesManager();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['note_id'])) {
    $noteId = $_GET['note_id'];
    $existingNotes = $notesManager->get();

    $editNote = null;
    foreach ($existingNotes as $note) {
        if ($note->getId() == $noteId) {
            $editNote = $note;
            break;
        }
    }

    if ($editNote) {
?>

        <?php include "templates/header.php"; ?>
        <body>
            <h2>Edit Note</h2>
            <form class="editNoteForm" method="POST" action="NoteUpdate.php">
                <input type="hidden" name="note_id" value="<?= $editNote->getId(); ?>">
                <div class="editFormTitle">
                    <label for="title">Edit Note Title</label>
                    <input class="editTitleInput" type="text" name="title" value="<?= htmlspecialchars($editNote->getTitle()); ?>">
                </div>
                <div class="editFormTitle noteInput">
                    <label for="content">Edit Note Content</label>
                    <textarea class="editTextboxInput" name="content"><?= htmlspecialchars($editNote->getContent()); ?></textarea>
                </div>
                <button class="updateButton" type="submit">Update Note</button>
                <a class="backButton" href="index.php">Cancel</a>
            </form>
        <?php include "templates/footer.php"; ?>

<?php
        exit();
    } else {
        echo "Note not found.";
    }
} else {
    echo "Invalid request.";
}
?>