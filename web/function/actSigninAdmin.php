<?php
    include "../conn.php";
    include "security.php";

    if (!empty($_POST) && $_SESSION['csrf'] == $_POST['csrf']) { 
        $email = sanitize(@$_POST['email']);
        $password = sha1(sanitize(@$_POST['password']));

        try {
            $failAttempt = $redis->get('LOGIN-FAIL-ATTEMPT:'.$email);
            if ($failAttempt >= 5) {
                header('Location: '.$host.'adminxyz.php?status=failed-blocked');
                exit;
            }
        } catch (Exception $e) {
            echo "Redis get failed: ".$e;
            exit;
        }

        if (isset($_POST['g-recaptcha-response'])) {
            $captcha=$_POST['g-recaptcha-response'];
        }
        if (!$captcha) {
            header('Location: '.$host.'adminxyz.php?status=failed-captcha' );
            exit;
        }
        $secretKey = getenv('RECAPTCHA_SECRET_KEY');
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        if(!$responseKeys["success"]) {
            header('Location: '.$host.'adminxyz.php?status=failed-captcha' );
            exit;
        }

        $sql = "SELECT * FROM admin where email = '$email' and password = '$password'";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                session_start();
                @$_SESSION["id"] = $row['id'];
                @$_SESSION["fullname"] = $row['fullname'];
                @$_SESSION['tipe'] = 'admin';
        
                header('Location: '.$host.'admin.php');
            }
        } else {
            try {
                $redis->set('LOGIN-FAIL-ATTEMPT:'.$email, $failAttempt+1, 'EX', 60*30);
            } catch (Exception $e) {
                echo "Redis set failed: ".$e;
                exit;
            }

            header('Location: '.$host.'adminxyz.php?status=failed' );
        }
        $conn->close();
    } else {
        header('location:' . $host . 'adminxyz.php?status=csrf');
    }
    $_SESSION['csrf'] =  bin2hex(random_bytes(35));

?>