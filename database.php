<?php


function get_connection()
{
    $file_database = @fopen('cheatmeals.txt', 'r') or die('Files does not exist');
    $database_host = fgets($file_database);
    preg_match('/host:(\S*)/', $database_host, $match1);
    // var_dump($match1[1]);
    $database_username = fgets($file_database);
    preg_match('/username:(\S*)/', $database_username, $match2);
    // var_dump($match2[1]);
    $database_password = fgets($file_database);
    preg_match('/password:(\S*)/', $database_password, $match3);
    // var_dump($match3[1]);
    $database_name = fgets($file_database);
    preg_match('/database:(\S*)/', $database_name, $match4);
    // var_dump($match4[1]);
    // var_dump($database_host,$database_name,$database_password,$database_username);
    fclose($file_database);
    $connection = mysqli_connect($match1[1], $match2[1], $match3[1], $match4[1]);
    if (mysqli_connect_errno())  echo 'Failed to connect to the MySQL server: ' . mysqli_connect_error();
    return $connection;
}

function query_database($connection, $sql)
{
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        throw new Exception("Preparation failed: " . mysqli_error($connection));
        die('Error making query' . mysqli_error($connection)); #preserve original behavior even if exception is handled.
    }
    mysqli_close($connection);
    return $result;
}


function prepare_bind_excecute($sql, $col_types, ...$cols)
{
    $conn = get_connection();
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception("Preparation failed: " . $conn->error); //IMPROVE: raise error instead
    $stmt->bind_param($col_types, ...$cols);
    if (!$stmt->execute()) throw new Exception("Execution failed: " . $stmt->error);
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return $result;
}


//TASK2: HOW TO protect your database from SQL injection attacks(*)/HTML injection attacks(*)
