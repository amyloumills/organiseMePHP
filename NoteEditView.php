<?php
require_once 'Classes/Note.php';
require_once 'Classes/SessionNotesManager.php';
require_once 'functions.php';

session_start();

$notesManager = new SessionNotesManager();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['note_id'])) {
    $noteId = $_GET['note_id'];
    $existingNotes = $notesManager->get();

    // Find the note with the given ID
    $editNote = null;
    foreach ($existingNotes as $note) {
        if ($note->getId() == $noteId) {
            $editNote = $note;
            break;
        }
    }

    if ($editNote) {

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>

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
        </body>

        </html>

<?php
        exit();
    } else {
        // Handle case where note with the given ID was not found
        echo "Note not found.";
    }
} else {
    // Handle invalid or missing note_id parameter
    echo "Invalid request.";
}
?>