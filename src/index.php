<?php
require 'Classes/Note.php';
require 'Autoloader.php';
require 'functions.php';
require_once 'connection.php';
global $conn;
use Classes\NoteActions;
use Classes\DatabaseNotesManager;

$notesManager = new DatabaseNotesManager($conn);

$allNotes = NoteActions::handleNoteGet($notesManager);

?>

<?php include "templates/header.php"; ?>
<h1>Organise Me is a simple note-taking app.</h1>

<!-- Add a new note -->

<form class="addNoteForm" method="POST" action="NoteCreate.php">
    <div class="formTitle">
        <label for="title">Add your title</label>
        <label>
            <input class="titleInput" type="text" name="title" placeholder="Title">
        </label>
    </div>
    <div class="formTitle noteInput">
        <label for="content">Add your note</label>
        <label>
            <textarea class="textboxInput" name="content" placeholder="Content"></textarea>
        </label>
    </div>
    <input type="checkbox" name="pinned" value="0">Pinned</input>
    <input type="checkbox" name="completed" value="0">Completed</input>
    <button class="createNoteButton" type="submit">Create Note</button>
</form>
<h2>My Notes</h2>

<!-- Display all existing notes -->
<!-- var dump notes -->
<?php var_dump($allNotes); ?>

<?php if (empty($allNotes)) : ?>
    <p>You have no notes.</p>
<?php endif; ?>
<?php if (!empty($allNotes)) : ?>
    <p>You have <?= count($allNotes); ?> note(s).</p>
<?php endif; ?>
<?php foreach ($allNotes as $note) : ?>

    <div class="allNotesContent">
        <h3><?= htmlspecialchars($note->getTitle()) ?></h3>
        <p><?= htmlspecialchars($note->getContent()) ?></p>
        <p>Pinned: <?= $note->getPinned() ? 'Yes' : 'No'; ?></p>
        <p>Completed: <?= $note->getCompleted() ? 'Yes' : 'No'; ?></p>
        <div class="editDeleteBtn">
            <form method="POST" action="NoteDelete.php">
                <input type="hidden" name="note_id" value="<?= $note->getId(); ?>">
                <button type="submit">Delete</button>

            </form>
            <form method="GET" action="NoteEditView.php">
                <input type="hidden" name="note_id" value="<?= $note->getId(); ?>">
                <button type="submit">Edit</button>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<?php include "templates/footer.php"; ?>