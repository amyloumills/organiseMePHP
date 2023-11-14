<?php

require 'Classes/NotesManager.php';

class SessionNotesManager implements NotesManager
{

    private $notes = []; // get rid of this. just deal with the session

    public function __construct()
    {
        if (isset($_SESSION['notes'])) {
            $this->notes = $_SESSION['notes'];
        }
    }

    public function add(Note $note)
    {
        $this->notes[] = $note;
        $_SESSION['notes'] = $this->notes;
    }

    public function update(Note $updatedNote)
    {
        foreach ($this->notes as $key => $note) {

            if ($note->getId() === $updatedNote->getId()) {
                $this->notes[$key] = $updatedNote;
                break;
            }
        }
        $_SESSION['notes'] = $this->notes;
    }

    function get()
    {
        return $this->notes;
    }

    public function delete($noteId)
    {
        $index = null;
        foreach ($this->notes as $key => $note) {
            if ($note->getId() === $noteId) {
                $index = $key;
                break;
            }
        }

        if ($index !== null) {
            // Remove the note from the list
            unset($this->notes[$index]);

            // Reindex the array
            $this->notes = array_values($this->notes);
        }
        $_SESSION['notes'] = $this->notes;
    }

    public function getById($noteId)
    {
        foreach ($this->notes as $note) {
            if ($note->getId() === $noteId) {
                return $note;
            }
        }
        return null;
    }
}
