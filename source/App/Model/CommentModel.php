<?php
require_once (__DIR__ . '/../config.php');
require_once 'BaseModel.php';


class CommentModel extends BaseModel{
    public function __construct(){
        global $pdo;
        $this->table = 'cart';
        self::$pdo = $pdo;
        $this->rows= ['bookid', 'memberid', 'time', 'content'];
    }

    /**
     * Summary of addComment
     * @param mixed $data: ["bookid"=> $bookid, "memberid"=> $memberid, "content"=> $content]
     * @return [$result, $msg]
     */
    public function addComment($data){
        try{
            $data = array_map('trim', $data);


            //print_r($data);

            $stmt = self::$pdo->prepare('INSERT INTO comment (bookID, memberID, content) VALUES (:bookID, :memberID, :content)');
            $memberid= $data['memberid'];
            $bookid= $data['bookid'];
            $content= $data['content'];

            $result = $stmt->execute([
                'bookID'=> $bookid,
                'memberID'=> $memberid,
                'content'=> $content
            ]);
            // print_r($data['bookid']);
            // print_r($data['memberid']);
            // print_r($data['content']);
            if($result){
                $msg ='Add comment successfully';
                return [true, $msg];
            }
            else{
                $msg = 'Add comment failed';
                return [false, $msg];
            }
        }
        catch(Exception $e){
            // echo $e->getMessage();
            $msg = "Add comment failed";
            return [false, $msg];
        }
    }

    /**
     * Summary of updateComment
     * @param mixed $data: ["bookid"=> $bookid, "memberid"=> $memberid, "time"=> $time, "content"=> $content]
     * @return array
     */
    public function updateComment($data){
        try{
            $stmt = self::$pdo->prepare("UPDATE comment SET content = :content WHERE bookid = :bookid AND memberid = :memberid AND time = :time");
            $result = $stmt->execute([
                'content'=> $data['content'],
                'bookid'=> $data['bookid'],
                'memberid'=> $data['memberid'],
                'time'=> $data['time']
            ]);
            if($result){
                $msg = 'Update comment successfully';
                return [true, $msg];
            }
            else{
                $msg = 'Update comment failed';
                return [false, $msg];
            }
        }catch(Exception $e){
            //echo $e->getMessage();
            $msg = "Update comment failed";
            return [false, $msg];
        }
    }

    /**
     * Summary of deleteComment
     * @param mixed $bookID
     * @param mixed $memberID
     * @param mixed $time
     * @return array
     */
    public function deleteComment($bookID, $memberID, $time){
        try{
            $stmt = self::$pdo->prepare("DELETE FROM comment WHERE bookid = :bookid AND memberid = :memberid AND time = :time");
            $result = $stmt->execute([
                'bookid'=> $bookID,
                'memberid'=> $memberID,
                'time'=> $time
            ]);
            if($result){
                $msg = 'Delete comment successfully';
                return [true, $msg];
            }
            else{
                $msg = 'Delete comment failed';
                return [false, $msg];
            }
        }catch(Exception $e){
            $msg = "Delete comment failed";
            return [false, $msg];
        }
    }

    /**
     * Summary of getAllComment
     * @param mixed $page
     * @param mixed $perPage
     * @param mixed $bookID: optional
     * @param mixed $memberID: optional
     * @param mixed $time: optional
     * @return [$result, $msg, $data]
     * $data = [$commentList, $count]
     */
    public function getAllComment($page, $perPage, $bookID = null , $memberID = null , $time = null){
        try{
            $conditions = [];
            if ($memberID) {
                $conditions[] = "c.memberid = :memberID";
            }
            if ($bookID) {
                $conditions[] = "c.bookid = :bookID";
            }

            if ($time) {
                $conditions[] = "c.time = :time";
            }

            $whereClause = count($conditions) > 0 ? " WHERE " . implode(" AND ", $conditions) : "";

            $lim = $perPage;
            $offset = ($page -1) * $perPage;

            $stmt = self::$pdo->prepare("
                SELECT (m.FirstName|| ' ' || m.LastName) AS Fullname, c.Time, c.Content
                FROM comment c
                JOIN member m ON c.memberid = m.id
                JOIN book b ON c.bookid = b.id 
                $whereClause 
                LIMIT $lim OFFSET $offset");

            $params = [];  
            if ($time) {
                $params['time'] = $time;
            }
            if ($bookID){
                $params['bookID'] = $bookID;
            }
            if ($memberID){
                $params['memberID'] = $memberID;
            }
            $stmt1= self::$pdo->prepare("SELECT COUNT(*) FROM comment c JOIN member m ON c.memberid = m.id JOIN book b ON c.bookid = b.id $whereClause");
            $stmt1->execute($params);
            $count = $stmt1->fetchColumn();

            $result = $stmt->execute($params);
            
            if(!$result){
                $msg = 'Get all comment failed';
                return [false, $msg, []];
            }else{
                $msg = 'Get all comment successfully';
                return [true, $msg, [$stmt->fetchAll(PDO::FETCH_ASSOC), $count]];
            }
            
        }catch(Exception $e){
            echo $e->getMessage();
            $msg = "Get all comment failed";
            return [false, $msg, []];
        }
    }
}