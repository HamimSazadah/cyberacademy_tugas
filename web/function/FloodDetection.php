
<?php

use Predis\Client;

class FloodDetection {
    private $redis;

    private $timeLimitUser = array (
            "DEFAULT" => 2,
            "CHAT" => 3,
            "LOGIN" => 4 
    );
    private $timeLimitProcess = array (
            "DEFAULT" => 0.1,
            "CHAT" => 1.5,
            "LOGIN" => 0.1 
    );

    function __construct() {
        try {
            $this->redis = new Client(['host'   => getenv('REDIS_HOST'), 'password' => getenv('REDIS_PASSWORD')]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function addUserlimit($key, $time) {
        $this->timeLimitUser [$key] = $time;
    }

    function addProcesslimit($key, $time) {
        $this->timeLimitProcess [$key] = $time;
    }

    public function quickIP() {
        return (empty ( $_SERVER ['HTTP_CLIENT_IP'] ) ? (empty ( $_SERVER ['HTTP_X_FORWARDED_FOR'] ) ? $_SERVER ['REMOTE_ADDR'] : $_SERVER ['HTTP_X_FORWARDED_FOR']) : $_SERVER ['HTTP_CLIENT_IP']);
    }

    public function check($action = "DEFAULT") {
        $ip = $this->quickIP ();
        $ipKey = "flood" . $action . sha1 ( $ip );

        $runtime = $this->redis->get ( 'floodControl' );
        $iptime = $this->redis->get ( $ipKey );

        $limitUser = isset ( $this->timeLimitUser [$action] ) ? $this->timeLimitUser [$action] : $this->timeLimitUser ['DEFAULT'];
        $limitProcess = isset ( $this->timeLimitProcess [$action] ) ? $this->timeLimitProcess [$action] : $this->timeLimitProcess ['DEFAULT'];

        if ((microtime ( true ) - $iptime) < $limitUser) {
            $_SESSION['csrf'] =  bin2hex(random_bytes(35));
            print ("Die! Die! Die! $ip") ;
            exit ();
        }

        // Limit All request
        if ((microtime ( true ) - $runtime) < $limitProcess) {
            $_SESSION['csrf'] =  bin2hex(random_bytes(35));
            print ("All of you Die! Die! Die! $ip") ;
            exit ();
        }

        $this->redis->set ( "floodControl", microtime ( true ));
        $this->redis->set ( $ipKey, microtime ( true ) );
    }

}

#https://stackoverflow.com/questions/10155339/prevent-php-script-from-being-flooded