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

        <body>
            <h2>Edit Note</h2>
            <form method="POST" action="NoteUpdate.php">
                <input type="hidden" name="note_id" value="<?= $editNote->getId(); ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Edit Note Title</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($editNote->getTitle()); ?>">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Edit Note Content</label>
                    <textarea name="content"><?= htmlspecialchars($editNote->getContent()); ?></textarea>
                </div>
                <button type="submit">Update Note</button>
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