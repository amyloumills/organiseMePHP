<?php
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

        $updatedNote = new Note($noteId, $newTitle, $newContent);
        $notesManager->update($updatedNote);
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

    public function handleNoteGetById($formData, $notesManager)
    {
        $noteId = $formData['note_id'];
        $notesManager->getById($noteId);
    }
}




//$note = $notesManager->getById($noteId);
//$note->setTitle($newTitle);
//$note->setContent($newContent);
