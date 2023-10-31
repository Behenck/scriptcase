<?php
function execute($query)
{
    $resultado = null;

    if ($query->type === 'select') {
        $sql_connection = $query->sql;
        $resultado_connection = array();

        sc_select(res_connection, $sql_connection);
		sc_commit_trans();
        if (false === $res_connection) {
            echo "Erro ao retornar os dados! <br> Erro: {res_connection_erro}";
            return false;
        }

        while (!$res_connection->EOF) {
            $objeto_connection = new stdClass();
            foreach ($res_connection->fields as $campo_connection => $valor_connection) {
                $objeto_connection->$campo_connection = $valor_connection;
            }
            $resultado_connection[] = $objeto_connection;
            $res_connection->MoveNext();
        }
        $res_connection->Close();

		if ($query->qtRegisters === 'first') {
			return !empty($resultado_connection) ? $resultado_connection[0] : false;
		} else {
			return $resultado_connection;
		}
		
    } else if ($query->type === 'update') {
		$sql_connection = $query->sql;

		$resultado = true;
		$resultado_execucao = sc_exec_sql($sql_connection);
		sc_commit_trans();
		if (false === $resultado_execucao) {
		  $resultado = false;
		}
	} else if ($query->type === 'delete') {
        $sql_connection = $query->sql;
        $resultado_execucao = sc_exec_sql($sql_connection);
		sc_commit_trans();
        $resultado = ($resultado_execucao !== false);
    } else if ($query->type === 'insert') {
		$sql_connection = $query->sql;
		$resultado_execucao = sc_exec_sql($sql_connection);
		sc_commit_trans();
		if ($resultado_execucao !== false) {
            sc_lookup(sd,"SELECT LAST_INSERT_ID()");
			$resultado = {sd[0][0]};
			sc_commit_trans();
        } else {
            $resultado = false;
        }
	} else if ($query->type === 'count') {
		$sql_connection = $query->sql;

        sc_lookup(res_connection, $sql_connection);
		sc_commit_trans();
        if (false === $res_connection) {
			$retornoLog = {res_connection_erro};
            echo "Erro ao retornar os dados! <br> Erro: {res_connection_erro}";
            return false;
        }

		return $res_connection[0][0];
	}
    return $resultado;
}
?>