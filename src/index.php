<?php
require 'Classes/Note.php';
session_start();
    require 'Autoloader.php';
    require 'functions.php';
    include 'dbconnection.php';

    use Classes\NoteActions;
    use Classes\SessionNotesManager;

    $notesManager = new SessionNotesManager();

    $allNotes = NoteActions::handleNoteGet($notesManager);

    $db = null;

    ?>

    <?php include "templates/header.php"; ?>
        <h1>Organise Me is a simple note-taking app.</h1>
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
            <button class="createNoteButton" type="submit">Create Note</button>

        </form>
        <h2>My Notes</h2>

        <!-- Display all existing notes -->
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

