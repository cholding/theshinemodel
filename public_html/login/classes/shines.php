<?php

class SHINES {

    private $_db;

    function __construct($db){
    	
    
    	$this->_db = $db;
    }

	public function search_fulltext($searchtext){	

		try {
			
			$stmt = $this->_db->prepare('SELECT id, audio_id, post_content FROM shines WHERE MATCH (post_content) AGAINST (:searchtext IN BOOLEAN MODE)');
			
			$stmt->execute(array('searchtext' => $searchtext));
			
			$row = $stmt->fetch();
			
			return $row['post_content'];

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

public function getaudioid($searchtext){	

		try {
			
			$stmt = $this->_db->prepare('SELECT id, audio_id, post_content FROM shines WHERE MATCH (post_content) AGAINST (:searchtext IN BOOLEAN MODE)');
			
			$stmt->execute(array('searchtext' => $searchtext));
			
			$row = $stmt->fetch();
			
			return $row['post_content'];

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}	
}
?>