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

function createUsersDatabase($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS `users` (
        `discord_email` varchar(255) NULL,
        `discord_username` varchar(255) NOT NULL,
        `discord_id` varchar(255) NOT NULL,
        `discord_avatar` varchar(255) NULL,
        `twitch_handle` varchar(255) NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`discord_id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
      } catch(Exception $e) {
        echo $e;
      }
      if(!getUserFromDatabase($pdo, "0")) addUserToDatabase($pdo, "0", NULL, NULL, "Deleted User", NULL);
}

function addUserToDatabase($pdo,$discord_id,$discord_avatar,$discord_email,$discord_username, $twitch_handle){
    $sql = "INSERT INTO users (discord_email,discord_username,discord_id,discord_avatar,twitch_handle) VALUES (:discord_email,:discord_username,:discord_id,:discord_avatar,:twitch_handle)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'discord_id'=>$discord_id,
            'discord_avatar'=>$discord_avatar,
            'discord_email'=>$discord_email,
            'discord_username'=>$discord_username,
            'twitch_handle'=>$twitch_handle
        ]);
    } catch (Exception $e) {
        echo $e;
    }
}

function updateUserInDatabase($pdo,$discord_id,$discord_avatar,$discord_email,$discord_username,$twitch_handle) {
    $sql = "UPDATE users SET
            discord_avatar = '$discord_avatar',
            discord_email = '$discord_email',
            discord_username = '$discord_username',
            twitch_handle ? '$twitch_handle'
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

function getUserByNameFromDatabase($pdo,$discord_username){
    $sql = "SELECT * FROM users WHERE discord_username=:discord_username";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'discord_username'=>$discord_username,
        ]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }
}

function deleteUserFromDatabase($pdo, $discord_id) {
    $sql = "DELETE FROM users WHERE discord_id = $discord_id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
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

function createNewspostDatabase($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS `news` (
        `post_id` int(11) NOT NULL AUTO_INCREMENT,
        `post_author` varchar(255) NOT NULL,
        `created_at` datetime NOT NULL,
        `edited_at` datetime NOT NULL,
        `post_title` tinytext NOT NULL,
        `post_text` longtext NOT NULL,
        PRIMARY KEY (`post_id`),
        CONSTRAINT fk_post_author FOREIGN KEY (post_author) REFERENCES users(discord_id)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
      } catch(Exception $e) {
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



function updateNewspostInDatabase($pdo,$post_id,$post_author,$post_title,$post_text) {
    $UTC_TIMESTAMP = "UTC_TIMESTAMP()";
    $sql = "UPDATE news SET
            post_author = \"$post_author\",
            post_title = '$post_title',
            post_text = \"$post_text\",
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
    $sql = "SELECT n.post_id, n.post_author, n.created_at, n.edited_at, n.post_title, n.post_text, u.discord_username, u.discord_avatar FROM news n
            LEFT JOIN users u ON (n.post_author = u.discord_id) 
            ORDER BY post_id desc";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }
}

function createHacksDatabase($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS `hacks` (
        `hack_id` int(11) NOT NULL AUTO_INCREMENT,
        `hack_name` varchar(255) NOT NULL,
        `hack_version` varchar(255) DEFAULT NULL,
        `hack_starcount` int(11) DEFAULT NULL,
        `hack_release_date` date DEFAULT NULL,
        `hack_patchname` varchar(255) NOT NULL,
        `hack_downloads` int(11) NOT NULL,
        `hack_tags` varchar(255) DEFAULT NULL,
        `hack_description` text DEFAULT NULL,
        `hack_verified` tinyint(1) NOT NULL,
        `hack_recommend` tinyint(1) NOT NULL,
        PRIMARY KEY (`hack_id`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
      } catch(Exception $e) {
        echo $e;
      }
}

function createHackAuthorsDatabase($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS `hacks_authors` ( 
        hack_id INT(11) NOT NULL, 
        author_id INT(11) NOT NULL, 
        CONSTRAINT fk_hack_id FOREIGN KEY (hack_id) REFERENCES hacks(hack_id),
        CONSTRAINT fk_author_id FOREIGN KEY (author_id) REFERENCES author(author_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch(Exception $e) {
            echo $e;
        }     
}

function createAuthorsDatabase($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS `author` (
        author_id INT(11) NOT NULL AUTO_INCREMENT,
        author_name VARCHAR(255) NOT NULL,
        PRIMARY KEY(`author_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
                try {
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                } catch(Exception $e) {
                    echo $e;
                }     
        
}

function addHackToDatabase($pdo,$hack_name,$hack_version,$hack_starcount,$hack_release_date,$hack_patchname,$hack_tags,$hack_description,$hack_verified){
    $sql = "INSERT INTO hacks (hack_name,hack_version,hack_starcount,hack_release_date,hack_patchname,hack_tags,hack_description,hack_verified) VALUES (:hack_name,:hack_version,:hack_starcount,:hack_release_date,:hack_patchname,:hack_tags,:hack_description,:hack_verified)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'hack_name'=>$hack_name,
            'hack_version'=>$hack_version,
            'hack_starcount'=>$hack_starcount,
            'hack_release_date'=>$hack_release_date,
            'hack_patchname'=>$hack_patchname,
            'hack_tags'=>$hack_tags,
            'hack_description'=>$hack_description,
            'hack_verified'=>$hack_verified
        ]);
    } catch (Exception $e) {
        echo $e;
    }
}

function getAuthorFromDatabase($pdo, $author_name) {
    $sql = "SELECT * FROM author WHERE author_name=:author_name";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'author_name'=>$author_name
        ]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $data;
    } catch (Exception $e) {
        echo $e;
    }

}

function addAuthorToDatabase($pdo, $author_name) {
    $sql = "INSERT INTO author (author_name) VALUES (:author_name)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'author_name'=>$author_name
        ]);
    } catch (Exception $e) {
        echo $e;
    }
}

function addHackAuthorToDatabase($pdo, $hack_id, $author_id) {
    $sql = "INSERT INTO hacks_authors (hack_id, author_id) VALUES (:hack_id,:author_id)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'hack_id'=>$hack_id,
            'author_id'=>$author_id
        ]);
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

function getHackFromDatabase($pdo, $hack_name) {
    $sql = "SELECT h.hack_id, h.hack_name, h.hack_version, h.hack_starcount, h.hack_release_date, h.hack_patchname, h.hack_downloads, h.hack_tags, h.hack_description, h.hack_verified, h.hack_recommend, GROUP_CONCAT(DISTINCT a.author_name SEPARATOR ', ') AS authors  FROM hacks h 
    LEFT JOIN hacks_authors ha ON (h.hack_id = ha.hack_id) 
    LEFT JOIN author a ON (ha.author_id = a.author_id) 
    WHERE h.hack_name=:hack_name AND hack_verified=1
    GROUP BY h.hack_id
    ORDER BY h.hack_recommend DESC, CASE WHEN h.hack_release_date = '9999-12-31' THEN 2 ELSE 1 END, h.hack_release_date DESC";
    
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



function getHackByUserFromDatabase($pdo, $user_name) {
    $sql = "SELECT * FROM hacks h
    LEFT JOIN hacks_authors ha ON (h.hack_id = ha.hack_id)
    LEFT JOIN author a ON (ha.author_id = a.author_id) 
    WHERE a.author_name LIKE '%$user_name%' AND hack_verified=1 GROUP BY hack_name";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch(Exception $e) {
        echo $e;
    }
} 

function getHacksByUserFromDatabase($pdo, $user_id) {
    $sql = "SELECT * FROM users u
            LEFT JOIN author a ON(u.discord_username=a.author_name or u.twitch_handle=a.author_name)
            LEFT JOIN hacks_authors ha ON(a.author_id=ha.author_id)
            LEFT JOIN hacks h ON(ha.hack_id=h.hack_id)
            WHERE discord_id='$user_id'
            GROUP BY h.hack_name
            ";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch(Exception $e) {
        echo $e;
    }

}



function getPatchesByUserFromDatabase($pdo, $user_id) {
    $sql = "SELECT * FROM hacks h
    LEFT JOIN hacks_authors ha ON (h.hack_id = ha.hack_id)
    LEFT JOIN author a ON (ha.author_id = a.author_id) 
    WHERE a.author_name = $user_name AND hack_verified=1";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch(Exception $e) {
        echo $e;
    }

}



function getAllPendingHacksFromDatabase($pdo){
    $sql = "SELECT * FROM hacks h
    LEFT JOIN hacks_authors ha ON (h.hack_id = ha.hack_id)
    LEFT JOIN author a ON (ha.author_id = a.author_id) 
    WHERE hack_verified=0 GROUP BY hack_name";
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
    $sql = "SELECT h.hack_name, GROUP_CONCAT(DISTINCT a.author_name SEPARATOR ', ') AS hack_author, MIN(h.hack_release_date) AS release_date, SUM(h.hack_downloads) AS total_downloads, h.hack_tags FROM hacks h 
    LEFT JOIN hacks_authors ha ON (h.hack_id = ha.hack_id) 
    LEFT JOIN author a ON (ha.author_id = a.author_id) 
    WHERE hack_verified=1 GROUP BY h.hack_name
    ORDER BY h.hack_name;";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }
}


function getPatchFromDatabase($pdo, $hack_id) {
    $sql = "SELECT * FROM hacks h 
    LEFT JOIN hacks_authors ha ON (h.hack_id = ha.hack_id) 
    LEFT JOIN author a ON (ha.author_id = a.author_id) 
    WHERE h.hack_id=:hack_id AND hack_verified=1;";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'hack_id'=>$hack_id
        ]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch(Exception $e) {
        echo $e;
    }
}


function getRandomHackFromDatabase($pdo) {
    $sql = "SELECT * FROM hacks WHERE hack_verified=1 ORDER BY RAND() LIMIT 1";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }

}


function getTotalDownloadCountForHackFromDatabase($pdo, $hack_name) {
    $sql = "SELECT SUM(hack_downloads) AS total_downloads FROM hacks WHERE hack_name = :hack_name";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'hack_name'=> $hack_name
        ]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch(Exception $e) {
        echo $e;
    }
}

function updatePatchInDatabase($pdo,$hack_id,$hack_name,$hack_version,$hack_starcount,$hack_release_date,$hack_verified){
    $sql = "UPDATE hacks SET 
            hack_name = \"$hack_name\",
            hack_version = \"$hack_version\",
            hack_starcount = $hack_starcount,
            hack_release_date = '$hack_release_date',
            hack_verified = $hack_verified
            WHERE hack_id = $hack_id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        echo $e;
    }
}

function updateAuthorInDatabase($pdo, $hack_id, $author_id, $new_author_name) {
    $sql = "UPDATE authors a, hacks_authors ha
    SET a.author_name=$new_author_name, ha.author_name=$new_author_name
    WHERE h.hack_id=$hack_id AND a.author_name=$old_author_name";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e;
        }
    
}



function recommendPatchFromDatabase($pdo, $hack_id) {
    $sql = "UPDATE hacks SET hack_recommend = 1 WHERE hack_id = $hack_id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch(Exception $e) {
        echo $e;
    }
}

function unrecommendPatchFromDatabase($pdo, $hack_id) {
    $sql = "UPDATE hacks SET hack_recommend = 0 WHERE hack_id = $hack_id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch(Exception $e) {
        echo $e;
    }

}

function verifyPatchInDatabase($pdo,$hack_id){
    $sql = "UPDATE hacks SET 
            hack_verified = 1
            WHERE hack_id = $hack_id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        echo $e;
    }
}

function updateDownloadCounter($pdo, $hack_id) {
    $sql = "UPDATE hacks SET hack_downloads=hack_downloads+1 WHERE hack_id=$hack_id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        echo $e;
    }
}

function updateHackInDatabase($pdo, $hack_name,$hack_tags, $hack_description) {
    $sql = "UPDATE hacks SET 
            hack_description = \"$hack_description\",
            hack_tags = \"$hack_tags\"
            WHERE hack_name = \"$hack_name\"";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch(Exception $e) {
        echo $e;
    }
}

function getAllTagsFromDatabase($pdo) {
    $sql = "SELECT hack_tags FROM hacks WHERE hack_tags <> \"\" AND hack_verified=1 GROUP BY hack_tags ORDER BY hack_tags";
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
    $sql = "DELETE FROM hacks WHERE hack_name = \"$hack_name\"";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        echo $e;
    }
}

function deletePatchFromDatabase($pdo, $hack_id) {
    $sql = "DELETE FROM hacks WHERE hack_id = $hack_id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch(Exception $e) {
        echo $e;
    }
}

function createClaimsDatabase($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS `claims` (`claim_id` INT NOT NULL AUTO_INCREMENT , `hack_id` INT NOT NULL , `user_id` VARCHAR(255) NOT NULL , `claimed_author` VARCHAR(255) NOT NULL , PRIMARY KEY (`claim_id`)) ENGINE = InnoDB";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch(Exception $e) {
        echo $e;
    }
}

function addClaimToDatabase($pdo, $hack_id, $user_id, $claimed_author) {
    $sql = "INSERT INTO claims (hack_id,user_id,claimed_author) VALUES (:hack_id,:user_id,:claimed_author)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'hack_id'=>$hack_id,
            'user_id'=>$user_id,
            'claimed_author'=>$claimed_author
        ]);
    } catch (Exception $e) {
        echo $e;
    }
 
}

function getClaimFromDatabase($pdo, $claim_id) {
    $sql = "SELECT * FROM claims WHERE claim_id = $claim_id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $data;
    } catch (Exception $e) {
        echo $e;
    }

}


function getClaimsFromDatabase($pdo) {
    $sql = "SELECT * FROM claims";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $data;
    } catch (Exception $e) {
        echo $e;
    }

}

function deleteClaimFromDatabase($pdo, $claim_id) {
    $sql = "DELETE FROM claims WHERE claim_id=$claim_id"; 
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch(Exception $e) {
        echo $e;
    }
}