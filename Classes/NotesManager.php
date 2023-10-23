<?php

interface NotesManager
{
    public function add(Note $note);
    public function update(Note $note);
    public function delete($noteId);
    public function get();
}


// think about getbyid
// replace loops with getbyid call