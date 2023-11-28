<?php

namespace Classes;

class DatabaseNotesManager implements NotesManager
{

    private $conn;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function add(Note $note)
    {
        $sql = "INSERT INTO notes (title, content, created_at, pinned, completed) VALUES (:title, :content, :created_at, :pinned, :completed)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':title', $note->getTitle(), \PDO::PARAM_STR);
        $stmt->bindValue(':content', $note->getContent(), \PDO::PARAM_STR);
        $stmt->bindValue(':created_at', $note->getCreatedAt() ? $note->getCreatedAt()->format('Y-m-d H:i:s') : null, \PDO::PARAM_STR);

        //$pinned = $note->getPinned();
        $completed = $note->getCompleted();

        $stmt->bindValue(':pinned', $note->getPinned(), \PDO::PARAM_BOOL);
        $stmt->bindValue(':completed', $note->getCompleted(), \PDO::PARAM_BOOL);

        $stmt->execute();
    }


    public function get()
    {
        $sql = "SELECT * FROM notes";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $notes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $notesList = [];
        foreach ($notes as $note) {
            $created_at = isset($note['created_at']) ? new \DateTime($note['created_at']) : null;
            $pinned = isset($note['pinned']) ? (bool)$note['pinned'] : null;
            $completed = isset($note['completed']) ? (bool)$note['completed'] : null;

            $notesList[] = new Note(
                $note['id'],
                $note['title'],
                $note['content'],
                $created_at,
                $pinned,
                $completed
            );
        }

        return $notesList;
    }

    public function delete($noteId)
    {
        $sql = "DELETE FROM notes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $noteId, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update(Note $updatedNote)
    {
        $sql = "UPDATE notes SET title = :title, content = :content, pinned = :pinned, completed = :completed WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':title', $updatedNote->getTitle(), \PDO::PARAM_STR);
        $stmt->bindValue(':content', $updatedNote->getContent(), \PDO::PARAM_STR);
        $stmt->bindValue(':pinned', $updatedNote->getPinned(), \PDO::PARAM_BOOL);
        $stmt->bindValue(':completed', $updatedNote->getCompleted(), \PDO::PARAM_BOOL);
        $stmt->bindValue(':id', $updatedNote->getId(), \PDO::PARAM_INT);
        $stmt->execute();
    }
    public function getById($noteId)
    {

        $sql = "SELECT * FROM notes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $noteId, \PDO::PARAM_INT);
        $stmt->execute();

        $noteData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$noteData) {
            return null;
        }

        return new Note(
            $noteData['id'],
            $noteData['title'],
            $noteData['content'],
            new \DateTime($noteData['created_at']),
            isset($noteData['pinned']) ? (bool)$noteData['pinned'] : null,
            isset($noteData['completed']) ? (bool)$noteData['completed'] : null
        );
    }
}
