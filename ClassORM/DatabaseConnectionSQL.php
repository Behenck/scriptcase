<?php
function table($tableName)
{
    return new QueryBuilder($tableName);
}

class QueryBuilder
{
    private $tableName;
    private $conditions;
    private $limit;
    private $orderBy;
    private $groupBy;
    private $columns;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->conditions = '';
        $this->limit = null;
        $this->orderBy = '';
        $this->groupBy = '';
        $this->columns = '*';
    }

    public function find($id, $columnNameId = 'id')
    {
        $sql = "SELECT * FROM `$this->tableName` WHERE $columnNameId = '$id'";
        return $sql;
    }

    public function all()
    {
        $sql = "SELECT *, count(*) as count FROM `$this->tableName`";
        return $sql;
    }

    public function where($columnNameId, $operator, $search)
    {
        $this->conditions = "WHERE $columnNameId $operator '$search'";
        return $this;
    }

    public function whereRaw($condition)
    {
        $this->conditions = "WHERE $condition";
        return $this;
    }

    public function take($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function orderBy($column)
    {
        $this->orderBy = "ORDER BY $column";
        return $this;
    }

    public function groupBy($column)
    {
        $this->groupBy = "GROUP BY $column";
        return $this;
    }

    public function has($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function get()
    {
        $sql = "SELECT $this->columns, count(*) as count FROM `$this->tableName` $this->conditions $this->groupBy $this->orderBy";
        
        if ($this->limit !== null) {
            $sql .= " LIMIT $this->limit";
        }

		$resultado = new stdClass();
		$resultado->sql = $sql;
		$resultado->type = 'select';
		$resultado->qtRegisters = 'get';
		
		return $resultado;
    }
    
    public function count()
    {
        $sql = "SELECT COUNT(*) FROM `$this->tableName` $this->conditions";
        $resultado = new stdClass();
		$resultado->sql = $sql;
		$resultado->type = 'count';
		
		return $resultado;
    }
    
    public function first()
	{
		$sql = "SELECT $this->columns FROM `$this->tableName` $this->conditions $this->groupBy $this->orderBy LIMIT 1";

		$resultado = new stdClass();
		$resultado->sql = $sql;
		$resultado->type = 'select';
		$resultado->qtRegisters = 'first';

		return $resultado;
	}
	
	public function update($data)
	{
		$values = array();
		foreach ($data as $column => $value) {
			$value = addslashes($value);
			$values[] = "`$column` = '$value'";
		}

		$sql = "UPDATE `$this->tableName` SET " . implode(', ', $values) . " $this->conditions";
		$query = new stdClass();
		$query->sql = $sql;
		$query->type = 'update';
		return $query;
	}
	
	public function delete()
	{
		$sql = "DELETE FROM `$this->tableName` $this->conditions";
		$query = new stdClass();
		$query->sql = $sql;
		$query->type = 'delete';
		return $query;
	}
	
	public function insert(array $data)
    {
        $columns = array_keys($data);
        $values = array_map([$this, 'quoteValue'], $data);

        $columnsSql = implode(', ', $columns);
        $valuesSql = implode(', ', $values);

        $sql = "INSERT INTO `$this->tableName` ($columnsSql) VALUES ($valuesSql)";

        $query = new stdClass();
        $query->sql = $sql;
        $query->type = 'insert';

        return $query;
    }

    private function quoteValue($value)
    {
        if (is_string($value)) {
            return "'" . addslashes($value) . "'";
        } elseif (is_bool($value)) {
            return $value ? '1' : '0';
        } elseif (is_null($value)) {
            return 'NULL';
        } else {
            return $value;
        }
    }
}
?>