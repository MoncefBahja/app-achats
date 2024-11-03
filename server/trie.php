<?php
    class Trie {
        private $root;
      
        function insert($name, $id) {
            $current = $this->root;
            for ($i = 0; $i < strlen($name); $i++) {
                if (!isset($current->children[$name[$i]])) {
                    $current->children[$name[$i]] = new TrieNode();
                }
                $current = $current->children[$name[$i]];
            }
            array_push($current->ids, $id);
        }
        
        function search($name) {
            $current = $this->root;
            for ($i = 0; $i < strlen($name); $i++) {
                if (!isset($current->children[$name[$i]])) {
                    return false;
                }
                $current = $current->children[$name[$i]];
            }
            return $current->ids;
        }

        function __construct() {
            $this->root = new TrieNode();
        }
    }

    class TrieNode {
        public $children = array();
        public $ids = array();
    }

    session_start();
    include('./config.php');

    $stmt = $conn->prepare("SELECT id, name FROM products");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $trie = new Trie();

    foreach($data as $row) {
        $trie->insert($row['name'], $row['id']);
    }

    if(!isset($_SESSION["trie"])) {
        $_SESSION["trie"] = $trie;
    }
     
?>