    <?php
    require 'Classes/Note.php';
    require 'Classes/SessionNotesManager.php';
    require 'Classes/NoteActions.php';
    require 'functions.php';

    include 'dbconnection.php';
    session_start();

    $notesManager = new SessionNotesManager();

    // Handle form submission to create a new note
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        NoteActions::handleNoteCreation($_POST, $notesManager);
        redirect('index.php');
    }

    $existingNotes = $notesManager->get();

    $db = null;


    ?>

    <?php include "templates/header.php"; ?>
        <h1>Organise Me is a simple note-taking app.</h1>
        <form class="addNoteForm" method="POST">
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
        <?php if (empty($existingNotes)) : ?>
            <p>You have no notes.</p>
        <?php endif; ?>
        <?php if (!empty($existingNotes)) : ?>
            <p>You have <?= count($existingNotes); ?> note(s).</p>
        <?php endif; ?>

        <?php foreach ($existingNotes as $note) : ?>
            <div class="allNotesContent">
                <h3><?= htmlspecialchars($note->getTitle()); ?></h3>
                <p><?= htmlspecialchars($note->getContent()); ?></p>
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

