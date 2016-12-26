<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 31/10/12 #

class MySql {
	private $conn;
	private $lastregister;
	
	public function __construct($bd) {
		$this->conn = mysqli_connect("localhost", "root", "senha malandra", $bd);
	}
	
	public function __destruct() {
		return mysqli_close($this->conn);
	}
	
	public function getLastId() {
		return $this->lastregister;
	}
	
	public function Query($query) {
		$datas = mysqli_query($this->conn, $query);
		$this->lastregister = mysqli_insert_id($this->conn);
		
		if (gettype($datas) == "object") {
			$fields = array();
			$finfo = $datas->fetch_fields();
			
			foreach($finfo as $val) {
				$fields[] = array(
					"fieldname" => $val->name,
					"type" => $val->type,
					"max_length" => $val->max_length
				);
			}
			
			$i = 0;
			$record = array();
			while ($data = $datas->fetch_array()) {
				$record[$i] = array();
				foreach ($fields as $f) {
					if (!is_numeric($f['fieldname'])) {
						switch ($f["type"]) {
							case 3:
							case 8:
								$record[$i][$f['fieldname']] = (int) $data[$f['fieldname']];
								break;
							case 1:
							case 16:
								$record[$i][$f['fieldname']] = (bool) $data[$f['fieldname']];
								break;
							case 12:
							case 11:
							case 10:
							case 9:
							case 8:
								$record[$i][$f['fieldname']] = (int) strtotime($data[$f['fieldname']]);
								break;
							case 246:
							case 4:
								$record[$i][$f['fieldname']] = (float) $data[$f['fieldname']];
								break;
							case 'NULL':
								$record[$i][$f['fieldname']] = NULL;
								break;
							default:
								$record[$i][$f['fieldname']] = stripslashes(trim($data[$f['fieldname']]));
							break;
						}
				}
					}
				$i++;
			}
			
			return $record;
		} else {
			return array();
		}
	}
}
?>