<?php

namespace Classes;

class NoteActions
{
    public static function handleNoteCreation($formData, $notesManager)
    {
        $title = $formData['title'];
        $content = $formData['content'];

        $pinned = isset($formData['pinned']) ? $formData['pinned'] : null;
        $completed = isset($formData['completed']) ? $formData['completed'] : null;

        $note = new Note(uniqid(), $title, $content, $pinned, $completed);
        $notesManager->add($note);
    }

    public static function handleNoteUpdate($formData, $notesManager)
    {
        $noteId = $formData['note_id'];
        $newTitle = $formData['title'];
        $newContent = $formData['content'];
        $pinned = isset($formData['pinned']) ? (bool)$formData['pinned'] : null;
        $completed = isset($formData['completed']) ? (bool)$formData['completed'] : null;

        $existingNote = $notesManager->getById($noteId);

        $existingNote->setTitle($newTitle);
        $existingNote->setContent($newContent);
        $existingNote->setPinned($pinned);
        $existingNote->setCompleted($completed);

        $notesManager->update($existingNote);
    }

    public static function handleNoteDelete($noteId, $notesManager)
    {
        $notesManager->delete($noteId);
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
