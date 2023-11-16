<?php

namespace Classes;

interface NotesManager
{
    public function add(Note $note);
    public function update(Note $note);
    public function delete($noteId);
    public function get();
    public function getById($noteId);
}
