<?php

/**
 * В классе реализован функционал позволяющий более быстро генерировать запросы к бд
 * Class DataBaseFunction
 */

class DataBaseFunction extends PDO
{
    /**
     * Getting information from the database
     * @param $table - table name
     * @param string $rows
     * @param null $join
     * @param null $where
     * @param null $order
     * @return bool
     */
    function select($table, $rows = '*', $join = null, $where = null, $order = null)
    {
        $q = 'SELECT ' . $rows . ' FROM ' . $table;
        if ($join != null)

            foreach ($join as list($tableJoin, $columnJoin)) {
                $q .= ' LEFT JOIN ' . $tableJoin . ' ON ' . $columnJoin;
            };

        if ($where != null)
            $q .= ' WHERE ' . $where;
        if ($order != null)
            $q .= ' ORDER BY ' . $order;

        $stmt = self::query($q);
        $result = $stmt->fetchAll();

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }

    /**
     * Insert new info from DB
     * @param $info $_POST request
     * @return bool
     *
     */
    public function insert($info)
    {
        if (isset($info['table'])) {
            $table = $info['table'];
            unset($info['table']);
        } else {
            return false;
        }

        $column = implode(', ', array_keys($info));
        $ph = null;

        $arrayLength = count($info);

        foreach (array_keys($info) as $item) {
            if (!--$arrayLength) {
                $ph .= ':' . $item . '';
                break;
            }
            $ph .= ':' . $item . ', ';
        }

        $q = 'INSERT INTO ' . $table . " ($column)" . ' VALUES ' . "($ph)";
        $stmt = self::prepare($q);
        $stmt->execute($info);

    }

    /**
     * Функция update получает массив где ключ-значение, равно параметр-значение в бд.
     * Отправляется на прямую без плейсхолдеров. Была проблема в реализации умножения значений столбцов
     * @param $info - массив с параметрами. Значение имя таблицы сохраняется и удаляется.
     * @param null $where
     * @return bool
     * TODO
     */
    public function update($info, $where = null)
    {
        if (isset($info['table'])) {
            $table = $info['table'];
        } else {
            return false;
        }

        unset($info['table']);

        $set = null;
        $k = array_keys($info);
        $arrayLength = count($info);

        foreach ($k as $item) {
            if (!--$arrayLength) {
                $set .= $item . ' = ' . $info[$item];
                break;
            }
            $set .= $item . ' = ' . $info[$item] . ', ';
        }

        $q = 'UPDATE ' . $table . ' SET ' . $set;

        if ($where) {
            $q .= ' WHERE ' . $where;
        }
        $stmt = self::query($q);
    }

}