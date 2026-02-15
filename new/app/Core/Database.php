<?php 
    class Database {
        private static $conn;

        public static function connect() {
            if (!self::$conn) {
                self::$conn = mysqli_connect(
                    'localhost',
                    'root',
                    '',
                    DB_NAME
                );
                if (!self::$conn) {
                    throw new Exception('Database connection failed: ' . mysqli_connect_error());
                }
            }
            return self::$conn;
        }

        public static function query($sql) {
            $conn = self::connect();
            if (!$conn) {
                throw new Exception('Database connection is null.');
            }
            return mysqli_query($conn, $sql);
        }

        public static function fetch($result) {
            return mysqli_fetch_assoc($result);
        }
    }

?>