<?
class Database {
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($host, $username, $password, $dbname) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        // Create connection
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8");
    }

    public function select($sql) {
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $data = [];
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else return [];
    }
    public function getItemProps($id) {
        $sql = "SELECT
            ip.id AS id,
            p.id AS prop_id,
            p.name AS name,
            ip.value AS value
        FROM item_props ip
        LEFT JOIN props p ON ip.prop_id = p.id
        
        WHERE ip.item_id=$id";
        return $this->select($sql);
    }
    public function getItem($id) {
        $sql = "SELECT * FROM items WHERE id = $id";
        return $this->select($sql)[0];
    }
    public function getItems($filter="", $limit=0, $offset=0, $order="") {
        $sql = "SELECT * FROM items";
        if(!empty($filter)) $sql.=" WHERE $filter";
        if(!empty($order)) $sql.=" ORDER BY $order";
        if($limit>0) $sql.=" LIMIT $limit";
        if($offset>0) $sql.=" OFFSET $offset";
        return $this->select($sql);
    }
    public function insertItem($data) {
        $cols = implode("`, `", array_keys($data));
        $vals = implode("', '", array_values($data));

        $sql = "INSERT INTO items (`$cols`) VALUES ('$vals')";
        echo $this->conn->real_escape_string($sql);
        $this->conn->query($sql);        
    }
    public function updateItem($id, $data) {
        $set = [];
        foreach ($data as $col=>$val) {
            if($col=="id") continue;
            $set[] = "`$col` = ".(is_numeric($val) ? $val : "'$val'");
        }
        $setQuery = implode(", ", $set);
        $sql = "UPDATE items SET $setQuery WHERE id = $id";
        $this->conn->query($sql);
    }
    public function getFiles($item_id) {
        $sql = "SELECT * FROM item_files WHERE item_id = $item_id";
        return $this->select($sql);
    }
    public function getCategoryTree() {
        $categories = $this->getItems("is_category=1");
        return $this->buildCategoryTree($categories);
    }
    public function buildCategoryTree($categories, $parentId=0, $depth=0) {
        $branch = [];
        foreach($categories as $category) {
            if($category["parent_id"]==$parentId) {
                $branch[$category["id"]] = [
                    "id"=>$category["id"],
                    "name"=>$category["name"],
                    "depth" => $depth,
                    "children" => $this->buildCategoryTree($categories, $category["id"], $depth+1)
                ];
            }
        }
        return $branch;
    }
}

$DB = new Database("sql106.infinityfree.com", "if0_36251117", "LUqpdQRjCTeOdW", "if0_36251117_delitech");