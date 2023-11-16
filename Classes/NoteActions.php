<?php

namespace Classes;

class NoteActions {
    public static function handleNoteCreation($formData, $notesManager)
    {
        $title = $formData['title'];
        $content = $formData['content'];

        $note = new Note(uniqid(), $title, $content);
        $notesManager->add($note);
    }

    public static function handleNoteUpdate($formData, $notesManager)
    {
        $noteId = $formData['note_id'];
        $newTitle = $formData['title'];
        $newContent = $formData['content'];

        $existingNote = $notesManager->getById($noteId);

        $existingNote->setTitle($newTitle);
        $existingNote->setContent($newContent);

        $notesManager->update($existingNote);
    }

    public static function handleNoteDelete($formData, $notesManager)
    {
        if (isset($formData['note_id'])) {
            $noteId = $formData['note_id'];
            $notesManager->delete($noteId);
        }
    }

    public static function handleNoteGet($notesManager)
    {
        return $notesManager->get();
    }

    public static function handleNoteGetById($formData, $notesManager)
    {
        $noteId = $formData['note_id'];
        return $notesManager->getById($noteId);
    }
}