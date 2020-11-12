<?php
class Article
{
    private $id, $name, $text, $author, $dateCreated, $comments;
    private $db;

    public function __construct($id = null)
    {
        $this->db = new Database();
        $this->id = $id;
        if ($id !== null) $this->loadArticle();
    }

    public function loadArticle()
    {
        $articleData = $this->db->selectRow('SELECT * FROM articles WHERE id = '.$this->id);
        $this->name = $articleData['name'];
        $this->text = $articleData['text'];
        $this->author = $articleData['creator_name'];
        $this->dateCreated = $articleData['date_created'];
    }

    public function create($name, $text, $author)
    {
        
    }

    public function addComment()
    {
        
    }

    public function getAllArticles()
    {
        $data = array();
        $allArticles = $this->db->selectAll('SELECT id FROM articles');
        foreach ($allArticles as $article) {
            $data[] = new Article($article['id']);
        }
        return $data;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $name = mysqli_real_escape_string($name);
        $this->name = $name;
    }

    public function setText($text)
    {
        $text = mysqli_real_escape_string($text);
        $this->text = $text;
    }

    public function setAuthor($author)
    {
        $author = mysqli_real_escape_string($author);
        $this->author = $author;
    }

    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }
}