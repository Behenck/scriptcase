# Documentação da Classe QueryBuilder

A classe `QueryBuilder` fornece uma interface para construir consultas SQL em PHP de forma programática. Ela permite criar consultas SELECT, INSERT, UPDATE e DELETE de maneira flexível.
Lembrando que a classe QueryBuilder `DatabaseConnectionSQL.php` apenas retorna a sql, a execução é feita pelo arquivo `DatabaseConnectionExecute.php`, pois o Scripcase não permite utilizar classes e métodos lookup no mesmo arquivo
o retorno da função `execute()`, retorna: 
- um boolean(false) caso erro
- um array de objetos caso uma pesquisa get() por exemplo
- um objeto caso uma pesquisa first()
- o id caso uma inserção
- numero totais de registros caso utilize o count()

## Métodos Disponíveis

1. **find($id, $columnNameId = 'id')**
   - Cria uma consulta SELECT para buscar um registro pelo ID.
  ```php
    $query = table('minha_tabela')->find(1);
    $response = execute($query);

2. **all()**
   - Cria uma consulta SELECT para buscar todos os registros da tabela.
   ```php
    $query = table('minha_tabela')->all();
    $response = execute($query);

3. **where($columnNameId, $operator = '=', $search = null)**
   - Adiciona uma cláusula WHERE à consulta.
   ```php
    $query = table('minha_tabela')->where('id', '>=', 1);
    $query = table('minha_tabela')->where('id', 1); # id = '1'
    $response = execute($query);

4. **whereRaw($condition)**
   - Adiciona uma cláusula WHERE personalizada à consulta.
   ```php
    $query = table('minha_tabela')->whereRaw("id = '1' AND id = '2'")->get();
    $response = execute($query);

5. **take($limit)**
   - Limita o número de registros retornados na consulta.
   ```php
    $query = table('minha_tabela')->take(10)->get();
    $response = execute($query);

6. **orderBy($column)**
   - Ordena os resultados da consulta por uma coluna específica.
   ```php
    $query = table('minha_tabela')->orderBy('data_publicacao')->get();
    $response = execute($query);

7. **groupBy($column)**
   - Agrupa os resultados da consulta por uma coluna específica.
   ```php
    $query = table('minha_tabela')->groupBy('data_publicacao')->get();
    $response = execute($query);

8. **has($columns)**
   - Define as colunas a serem selecionadas na consulta.
   ```php
    $query = table('minha_tabela')->has('nome')->where('ativo', '=', 1)->get();
    $response = execute($query);

9. **get()**
   - Executa a consulta e retorna os resultados como uma consulta SELECT.
   ```php
    $query = table('minha_tabela')->where('destaque', 1)->get();
    $response = execute($query);
  ```
  - Podendo ser recuperado como:
  echo $response[0]->id;
  ou com um laço de repetição para recuperar cada item do array

10. **count()**
    - Retorna o número de registros que atendem aos critérios da consulta.
    ```php
    $query = table('minha_tabela')->where('situacao', 'ativo')->count();
    $response = execute($query);
    echo $response # mostra por ex: 5, contabiliza quantos registros existem com a situacao ativa

11. **first()**
    - Retorna o primeiro registro que atende aos critérios da consulta.
    ```php
    $query = table('minha_tabela')->where('situacao', 'ativo')->first();
    $response = execute($query);
    echo $response->id # mostra por ex: 1

12. **update($data)**
    - Cria uma consulta UPDATE para atualizar registros na tabela.
    ```php
    $data = ['coluna1' => 'valor1', 'coluna2' => 'valor2'];
    $query = table('minha_tabela')->where('id',1)->update($data);
    execute($query);

13. **delete()**
    - Cria uma consulta DELETE para excluir registros da tabela.
    ```php
    $query = table('minha_tabela')->where('id', 1)->delete();
    execute($query);

14. **insert(array $data)**
    - Cria uma consulta INSERT para adicionar novos registros à tabela.
    ```php
    $data = ['coluna1' => 'valor1', 'coluna2' => 'valor2'];
    $query = table('minha_tabela')->insert($data);
    $response = execute($query);
    ```
    - Ao inserir os dados o retorno é o id inserido.

    ### Poderá ser buscado a quantidade total de registros apenas executando 
    ```php
        $response->count ou $response[0]->count # retorno do execute($query)
    ``` que retornará a quantidade total de registros obtidos

É importante lembrar que a classe `QueryBuilder` não executa as consultas, mas gera os comandos SQL que podem ser executados posteriormente em seu banco de dados.
A conexão ao banco de dados não precisa ser feita, pois a classe `execute()` usa o método `lookup e sc_exec_sql`.
Basta copiar o código dos arquivos `DatabaseConnectionExecute` e `DatabaseConnectionSQL` para bibliotecas internas e ativando-as nos apps (Programação -> bibliotecas internas)

