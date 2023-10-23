<?php

function handleNoteCreation($formData, $notesManager)
{
    $title = $formData['title'];
    $content = $formData['content'];

    $note = new Note(uniqid(), $title, $content);
    $notesManager->add($note);
}



function redirect($location)
{
    header("Location: $location");
    exit();
}
