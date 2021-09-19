<?php

    function pre($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    class CProducts
    {
        private $mysql;

        public function __construct()
        {
            $connection = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/connection.ini");
            $this->mysql = new mysqli($connection['host'],$connection['login'],$connection['password'],$connection['db']);
            $this->mysql->set_charset('utf-8');
        }

        private function select($value, $table, $where = '', $order = '', $limit = '', $report = '')
        {
            if ($where != '') { $where = " WHERE {$where}"; }
            if ($order != '') { $order = " ORDER BY {$order}"; }
            if ($limit != '') { $limit = " LIMIT {$limit}"; }

            $result = $this->mysql->query("SELECT {$value} FROM {$table}{$where}{$order}{$limit}");
            if ($report == 1) { echo "SELECT {$value} FROM {$table}{$where}{$order}{$limit}"; }

            return $result;
        }

        private function update($table, $cell, $value, $where = '', $report = '')
        {
            if ($where != '') { $where = " WHERE {$where}"; }

            $result = $this->mysql->query("UPDATE {$table} SET {$cell} = '{$value}'{$where}");
            if ($report == 1) { echo "UPDATE {$table} SET {$cell} = '{$value}'{$where}"; }
        }

        public function select_products($limit = '')
        {
            $productsTemp = $this->select("*","Products","`STATUS` = '1'","`DATE_CREATE` DESC","{$limit}");
            if ($productsTemp)
            {
                while ($arr = mysqli_fetch_array($productsTemp))
                { $products[$arr['PRODUCT_ID']] = $arr; }

                if ($products != '')
                {
                    foreach ($products as $key => $value)
                    {
                        foreach ($value as $key2 => $value2)
                        {
                            if ((is_numeric($key2)) || ($key2 == 'ID') || ($key2 == 'PRODUCT_ID') || ($key2 == 'STATUS'))
                            { unset($products[$key][$key2]); }
                        }
                    }
                }
            }

            return $products;
        }

        public function quantity()
        {
            $currentQuantity = implode(mysqli_fetch_row($this->select("PRODUCT_QUANTITY","Products","`PRODUCT_ID` = '{$_POST['id']}'")));

            if ($_POST['q_edit'] == '+') { $currentQuantity++; }
            elseif ($_POST['q_edit'] == '-') { $currentQuantity--; }

            $this->update("Products","PRODUCT_QUANTITY","{$currentQuantity}","`PRODUCT_ID` = '{$_POST['id']}'");
            header("Location: /");
        }

        public function hid()
        {
            $this->update("Products","STATUS","0","`PRODUCT_ID` = '{$_POST['id']}'");
            header("Location: /");
        }

    }
?>