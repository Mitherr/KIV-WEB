<?php
class reviews extends db_pdo
{
    
    //načtení review podle id
    public function loadReview($id)
    {
        $table_name = "reviews";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_review",
            "value" => $id,
            "symbol" => "="
        );
        
        $review = $this->DBSelectOne($table_name, $columns, $where);
        
        return $review;
    }
    
    //odstranení review podle id
    public function removeReview($reviewid)
    {
        $table_name = "reviews";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_review",
            "value" => $reviewid,
            "symbol" => "="
        );
        
        $reviewd = $this->DBDelete($table_name, $where);
        return $reviewd;
    }
    
    //načtení všech review podle id článku
    public function loadAllReviews($id)
    {
        $table_name = "reviews";
        $columns    = "*";
        $where[]    = array(
            "column" => "articles_id_articles",
            "value" => $id,
            "symbol" => "="
        );
        
        $review = $this->DBSelectAll($table_name, $columns, $where);
        return $review;
    }
    
    //update locked
    public function upLocked($id, $value)
    {
        $table_name = "reviews";
        $column[]   = array(
            "column" => "review_locked",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_review",
            "value" => $id,
            "symbol" => "="
        );
        
        $review = $this->DBUpdate($table_name, $column, $where);
        return $review;
    }
    
    //update contentu podle id
    public function upText($id, $value)
    {
        $table_name = "reviews";
        $column[]   = array(
            "column" => "review_text",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_review",
            "value" => $id,
            "symbol" => "="
        );
        
        $review = $this->DBUpdate($table_name, $column, $where);
        return $review;
    }
    
    //update hodnocení podle id
    public function upOriginality($id, $value)
    {
        $table_name = "reviews";
        $column[]   = array(
            "column" => "review_originality",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_review",
            "value" => $id,
            "symbol" => "="
        );
        
        $review = $this->DBUpdate($table_name, $column, $where);
        return $review;
    }
    
     //update hodnocení podle id
    public function upTheme($id, $value){
        $table_name = "reviews";
        $column[]   = array(
            "column" => "review_theme",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_review",
            "value" => $id,
            "symbol" => "="
        );
        
        $review = $this->DBUpdate($table_name, $column, $where);
        return $review;
    }
    
     //update hodnocení podle id
    public function upQuality($id, $value){
        $table_name = "reviews";
        $column[]   = array(
            "column" => "review_quality",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_review",
            "value" => $id,
            "symbol" => "="
        );
        
        $review = $this->DBUpdate($table_name, $column, $where);
        return $review;
    }
    
    //získání všech recenzí když je admin když ne jen jeho
    public function LoadAllReviewsAdmin($id, $rights)
    {
        $table_name = "reviews";
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
        
        $review = $this->DBSelectAll($table_name, $columns, $where);
        return $review;
    }
    
    //přidání review
    public function addreview($id, $post)
    {
        $table_name            = "reviews";
        $item                  = array();
        $item['users_id_user']       = $id;
        $item['articles_id_articles']      = $post;
        
        $review = $this->DBInsert($table_name, $item);
        return $review;
    }
    
}