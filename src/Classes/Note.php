<?php

namespace Classes;

class Note
{
    private $id;
    private $title;
    private $content;
    private $createdAt;
    private $pinned;
    private $completed;

    public function __construct($id, $title, $content, $created_at = null, $pinned = null, $completed = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->createdAt = $created_at !== null ? $created_at : new \DateTime();
        $this->pinned = $pinned;
        $this->completed = $completed;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->createdAt instanceof \DateTime ? $this->createdAt : null;
    }

    public function getPinned()
    {
        return isset($this->pinned) ? $this->pinned : null;
    }

    public function getCompleted()
    {
        return isset($this->completed) ? $this->completed : null;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setPinned($pinned)
    {
        $this->pinned = $pinned;
    }

    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }
}
