    <?php
    require 'Classes/Note.php';
    require 'Classes/SessionNotesManager.php';
    require 'functions.php';

    session_start();

    $notesManager = new SessionNotesManager();

    // Handle form submission to create a new note
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        handleNoteCreation($_POST, $notesManager);
        redirect('index.php');
    }

    $existingNotes = $notesManager->get();

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Organise Me</title>
    </head>

    <body>

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

        <!-- replace loop with getById call -->


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

    </body>

    </html>