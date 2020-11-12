<?php
class Comment
{
    private $id, $articleId, $text, $author, $dateCreated, $email;
    private $db;

    public function __construct($id = null)
    {
        $this->db = new Database();
        $this->id = $id;
        if ($id !== null) $this->loadComment();
    }

    public function loadComment()
    {
        $commentData = $this->db->selectRow('SELECT * FROM comments WHERE id = '.$this->id);
        $this->text = $commentData['text'];
        $this->author = $commentData['creator_name'];
        $this->dateCreated = $commentData['date_created'];
        $this->email = $commentData['email'];
    }

    public function create($articleId, $text, $author, $email)
    {
        $this->setArticleId($articleId);
        $this->setText($text);
        $this->setAuthor($author);
        $this->setEmail($email);

        $this->insertData();
        $this->getInsertedComment();

        return $this->id;
    }

    public function insertData()
    {
        $this->db->beginTransaction();
        $query = "INSERT INTO comments (text, creator_name, email, article_id) VALUES ('$this->text', '$this->author', '$this->email', '$this->articleId')";

        $res = $this->db->exec($query);
        if ($res === false) die ('Error Inserting ' . $query);
        $this->db->commit();
    }

    public function getInsertedComment()
    {
        $data = $this->db->selectRow("SELECT * FROM comments WHERE creator_name = '$this->author' AND text = '$this->text'");
        $this->dateCreated = $data['date_created'];
        $this->id = $data['id'];
    }

    public function getId()
    {
        return $this->id;
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

    public function getEmail()
    {
        return $this->email;
    }

    public function getArticleId()
    {
        return $this->articleId;
    }

    public function setArticleId($id)
    {
        $this->articleId = $id;
    }

    public function setId($id)
    {
        $this->id = $id;
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

    public function setEmail($email)
    {
        $email = $this->db->escape($email);
        $this->email = $email;
    }
}