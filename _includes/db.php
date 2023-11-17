<?php

include($_SERVER['DOCUMENT_ROOT'].'/_includes/config.php');


$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$db = DB_NAME;

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){
  echo "Connection failed: " . $e->getMessage();
}

function addUserToDatabase($pdo,$discord_id,$discord_avatar,$discord_email,$discord_username){
    $sql = "INSERT INTO users (discord_email,discord_username,discord_id,discord_avatar) VALUES (:discord_email,:discord_username,:discord_id,discord_avatar)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'discord_id'=>$discord_id,
            'discord_avatar'=>$discord_avatar,
            'discord_email'=>$discord_email,
            'discord_username'=>$discord_username
        ]);
    } catch (Exception $e) {
        echo $e;
    }
}

function updateUserInDatabase($pdo,$discord_id,$discord_avatar,$discord_email,$discord_username) {
    $sql = "UPDATE users SET
            discord_avatar = '$discord_avatar',
            discord_email = '$discord_email',
            discord_username = '$discord_username'
            WHERE discord_id = '$discord_id'";

    try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } 
    catch (Exception $e) {
        echo $e;
    }      
}


function getUserFromDatabase($pdo,$discord_id){
    $sql = "SELECT * FROM users WHERE discord_id=:discord_id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'discord_id'=>$discord_id,
        ]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }
}

function getAllUsersFromDatabase($pdo){
    $sql = "SELECT * FROM users";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }
}

function addNewspostToDatabase($pdo, $post_title, $post_text, $post_author) {
    $sql = "INSERT INTO news (post_title,post_text,post_author,created_at, edited_at) VALUES (:post_title,:post_text,:post_author,UTC_TIMESTAMP(),UTC_TIMESTAMP())";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'post_title'=>$post_title,
            'post_text'=>$post_text,
            'post_author'=>$post_author,
        ]);
    } catch (Exception $e) {
        echo $e;
    }

}

function deleteNewspostFromDatabase($pdo, $post_id) {
    $sql = "DELETE FROM news WHERE post_id = $post_id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        echo $e;
    }

}



function updateNewspostInDatabase($pdo,$post_id,$post_title,$post_text) {
    $UTC_TIMESTAMP = "UTC_TIMESTAMP()";
    $sql = "UPDATE news SET
            post_title = '$post_title',
            post_text = '$post_text',
            edited_at = $UTC_TIMESTAMP
            WHERE post_id = $post_id";

    try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } 
    catch (Exception $e) {
        echo $e;
    }      
}


function getNewspostFromDatabase($pdo, $post_id){
    $sql = "SELECT * FROM news WHERE post_id=:post_id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'post_id'=>$post_id,
        ]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }
}

function getAllNewspostsFromDatabase($pdo){
    $sql = "SELECT * FROM news ORDER BY post_id desc";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }
}

function addHackToDatabase($pdo,$hack_name,$hack_version,$hack_author,$hack_starcount,$hack_release_date,$hack_patchname,$hack_tags){
    $sql = "INSERT INTO hacks (hack_name,hack_version,hack_author,hack_starcount,hack_release_date,hack_patchname,hack_tags) VALUES (:hack_name,:hack_version,:hack_author,:hack_starcount,:hack_release_date,:hack_patchname,:hack_tags)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'hack_name'=>$hack_name,
            'hack_version'=>$hack_version,
            'hack_author'=>$hack_author,
            'hack_starcount'=>$hack_starcount,
            'hack_release_date'=>$hack_release_date,
            'hack_patchname'=>$hack_patchname,
            'hack_tags'=>$hack_tags
        ]);
    } catch (Exception $e) {
        echo $e;
    }
}

function getHackFromDatabase($pdo, $hack_name) {
    $sql = "SELECT * FROM hacks WHERE hack_name=:hack_name ORDER BY hack_version DESC";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'hack_name'=>$hack_name
        ]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }

}

function getRandomHackFromDatabase($pdo) {
    $sql = "SELECT * FROM hacks ORDER BY RAND() LIMIT 1";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }

}

function updateHackInDatabase($pdo,$hack_name,$hack_version,$hack_author,$hack_starcount,$hack_release_date,$hack_patchname,$hack_tags){
    $sql = "UPDATE hacks SET 
            hack_name = '$hack_name',
            hack_version = '$hack_version',
            hack_author = '$hack_author',
            hack_starcount = '$hack_starcount',
            hack_release_date = '$hack_release_date',
            hack_patchname = '$hack_patchname',
            hack_tags = '$hack_tags'
            WHERE hack_name = '$hack_name'";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        echo $e;
    }
}

function getAllHacksFromDatabase($pdo){
    $sql = "SELECT * FROM hacks ORDER BY hack_name";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }
}

function getAllUniqueHacksFromDatabase($pdo){
    $sql = "SELECT hack_name, MIN(hack_release_date) AS release_date, MIN(hack_author) AS author, hack_tags FROM hacks GROUP BY hack_name";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }
}

function getAmountOfHacksInDatabase($pdo){
    $sql = "SELECT COUNT(*) AS 'count' FROM hacks";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $data;
    } catch (Exception $e) {
        echo $e;
    }
}

function deleteHackFromDatabase($pdo, $hack_name) {
    $sql = "DELETE FROM hacks WHERE hack_name = '$hack_name'";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        echo $e;
        header("Location: /404.php");
    }

}

