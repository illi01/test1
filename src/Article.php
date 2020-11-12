<?php
class Article
{
    private $id, $name, $text, $author, $dateCreated, $comments = false;
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

        $this->loadComments();
    }

    public function create($name, $text, $author)
    {
        $this->setName($name);
        $this->setText($text);
        $this->setAuthor($author);

        $this->insertData();
        $this->getInsertedArticle();

        return $this->id;
    }

    public function insertData()
    {
        $this->db->beginTransaction();
        $query = "INSERT INTO articles (name, text, creator_name) VALUES ('$this->name', '$this->text', '$this->author')";

        $res = $this->db->exec($query);
        if ($res === false) die ('Error Inserting ' . $query);
        $this->db->commit();
    }

    public function getInsertedArticle()
    {
        $data = $this->db->selectRow("SELECT * FROM articles WHERE name = '$this->name' AND text = '$this->text'");
        $this->dateCreated = $data['date_created'];
        $this->id = $data['id'];
    }

    public function addComment($text, $author, $email)
    {
        $comment = new Comment();
        $comment->create($this->id, $text, $author, $email);
    }

    public function loadComments()
    {
        $data = array();
        $allComments = $this->db->selectAll('SELECT id FROM comments WHERE article_id = '.$this->id);
        foreach ($allComments as $comment) {
            $data[] = new Comment($comment['id']);
        }
        $this->comments = $data;
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
        $id = $this->db->escape($id);
        $this->id = $id;
    }

    public function setName($name)
    {
        $name = $this->db->escape($name);
        $this->name = $name;
    }

    public function setText($text)
    {
        $text = $this->db->escape($text);
        $this->text = $text;
    }

    public function setAuthor($author)
    {
        $author = $this->db->escape($author);
        $this->author = $author;
    }
}