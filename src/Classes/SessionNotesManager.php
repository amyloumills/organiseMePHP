<?php

namespace Classes;

class SessionNotesManager implements NotesManager
{

    private $notes = [];

    public function __construct()
    {
        if (isset($_SESSION['notes'])) {
            $this->notes = $_SESSION['notes'];
        }
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

}
