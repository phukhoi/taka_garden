<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataProvider
 *
 * @author Zenit
 */
define("SERVER", "localhost");
define("DB", "db_taka");
define("UID", "rootss");
define("PWD", "root");

class DataProvider
{

    public static function execQuery($sql)
    {
        $cn = mysqli_connect("localhost", "root", "root", "db_taka") or die ('Không thể kết nối tới database');

        $result = mysqli_query($cn, $sql);
        if (!$result) {
            die ('Câu truy vấn bị sai');
        }

        return $result;
    }

    public static function execNonQueryAffectedRows($sql)
    {
        $cn = mysqli_connect(SERVER, UID, PWD) or
        die("Không thể kết nối vào máy chủ");

        mysqli_select_db(DB, $cn);
        mysqli_query("set names 'utf8'");

        if (!mysqli_query($sql, $cn))
            die("Lỗi truy vấn: " . mysqli_error());

        $affected_rows = mysqli_affected_rows();
        mysqli_close($cn);

        return $affected_rows;
    }

    public static function execNonQueryIdentity($sql)
    {
        $cn = mysqli_connect(SERVER, UID, PWD) or
        die("Không thể kết nối vào máy chủ");

        mysqli_select_db(DB, $cn);
        mysqli_query("set names 'utf8'");

        if (!mysqli_query($sql, $cn))
            die("Lỗi truy vấn: " . mysql_error());

        $id = mysqli_insert_id();
        mysqli_close($cn);

        return $id;
    }

}

?>