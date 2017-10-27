<?php
class articles extends db_pdo
{
    //načtení článku podle id
    public function loadArticle($id)
    {
        $table_name = "articles";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_articles",
            "value" => $id,
            "symbol" => "="
        );
        
        $article = $this->DBSelectOne($table_name, $columns, $where);
        
        return $article;
    }
    
    //odstranění článku podle id
    public function removeArticle($id)
    {
        $table_name = "articles";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_articles",
            "value" => $id,
            "symbol" => "="
        );
        
        $postd = $this->DBDelete($table_name, $where);
        return $postd;
    }
    
    //načtení všech postů, které jsou publikované
    public function loadAllArticles()
    {
        $table_name = "articles";
        $columns    = "*";
        $where[]    = array(
            "column" => "article_published",
            "value" => "1",
            "symbol" => "="
        );
        
        $article = $this->DBSelectAll($table_name, $columns, $where);
        return $article;
    }
    
    //update published
    public function upPublished($id, $value)
    {
        $table_name = "articles";
        $column[]   = array(
            "column" => "article_published",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_articles",
            "value" => $id,
            "symbol" => "="
        );
        
        $article = $this->DBUpdate($table_name, $column, $where);
        return $article;
    }
    
    //update Titulku
    public function upTitle($id, $value)
    {
        $table_name = "articles";
        $column[]   = array(
            "column" => "article_title",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_articles",
            "value" => $id,
            "symbol" => "="
        );
        
        $article = $this->DBUpdate($table_name, $column, $where);
        return $article;
    }
    
    //update textu
    public function upText($id, $value)
    {
        $table_name = "articles";
        $column[]   = array(
            "column" => "article_abstract",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_articles",
            "value" => $id,
            "symbol" => "="
        );
        
        $article = $this->DBUpdate($table_name, $column, $where);
        return $article;
    }
    
    //načtení všech článku pokud je admin pokud ne jen autorovo články
    public function loadAllArticlesAdmin($id, $rights)
    {
        $table_name = "articles";
        $columns    = "*";
        if ($rights == "3") {
            $where[] = array(
                "column" => "users_id_user",
                "value" => "null",
                "symbol" => "!="
            );
        } else {
            $where[] = array(
                "column" => "users_id_user",
                "value" => $id,
                "symbol" => "="
            );
        }
        
        $article = $this->DBSelectAll($table_name, $columns, $where);
        return $article;
    }
    
    //přidání článku
    public function addArticle($id, $title, $content, $pdf)
    {
        $table_name          = "articles";
        $item                = array();
        $item['users_id_user']     = $id;
        $item['article_title']   = $title;
        $item['article_abstract'] = $content;
        $item['article_pdf_name']        = $pdf;
        
        $article = $this->DBInsert($table_name, $item);
        return $article;
    }
    
}