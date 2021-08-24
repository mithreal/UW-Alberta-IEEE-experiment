<?php

function sqlRow($sql, $conn) {
    //$res = mysqli_query($conn, $sql);
    if ($res = mysqli_query($conn, $sql)) {
        //echo "Table $table created successfully.";
    } else {
        return false;
    }
    $row = mysqli_fetch_array($res, MYSQLI_NUM);
    return $row;
}

function robustSQLRow($sql, $conn) {
    $try = 0;
    if ($res = mysqli_query($conn, $sql)) {
    } else {
        do {
            if ($res = mysql_query($conn, $sql)) {
                break;
            } else {
                $try++;
            }
        } while ($try < 4);
    }
    if ($res != false) {
        $row = mysqli_fetch_array($res, MYSQLI_NUM);
        return $row;
    } else {
        return false;
    }
}

function runSQL($sql, $conn) {
    // runs sql querry with no return value
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function robustRunSQL($sql, $conn) {
    $try = 0;
    if (runSQL($sql, $conn)) {
        return true;
    } else {
        do {
            if (runSQL($sql, $conn)) {
                return true;
            } else {
                $try++;
            }
        } while ($try < 4);
        return false;
    }
}

function updateLOLA($listName, $id, $conn) {
    // sets the list on list_of_lists_A to LOCK, sets a timestamp, sets the session id
    // resets all date values in $listName to 0
    $sql1 = "UPDATE list_of_lists_A SET Used = 'LOCK' WHERE list_name = '$listName'";
    $sql2 = "UPDATE list_of_lists_A SET date = CURRENT_TIMESTAMP WHERE list_name = '$listName'";
    $sql3 = "UPDATE list_of_lists_A SET session_id = '$id' WHERE list_name = '$listName'";
    $sql4 = "UPDATE $listName SET DATE = timestampadd(MINUTE, 1, '1900-01-01')";
    robustRunSQL($sql1, $conn);
    robustRunSQL($sql2, $conn);
    robustRunSQL($sql3, $conn);
    robustRunSQL($sql4, $conn);
}

function checkExists($table, $conn) {
    // Check if table TT_# exists
    $sql = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'survey' AND table_name = '$table'";
    $row = robustSQLRow($sql, $conn);

    if ($row[0] == 0) {
        return false;
    } else {
        return true;
    }
}

function createTable($table, $conn) {
    // creates table named for $table
    $sql = "CREATE TABLE $table (id INT PRIMARY KEY auto_increment, Response VARCHAR(1024), List_ID VARCHAR(255),fileName VARCHAR(55), Session_ID VARCHAR(55), date DATETIME)";
    if (mysqli_query($conn, $sql)) {
        //echo "Table $table created successfully.";
    } else {
        die("Connection failed: " . mysqli_connect_error());
    }
}

function findCurrentRowID ($table, $conn) {
    // finds $table current row
    $sql = "SELECT id from $table ORDER BY id DESC LIMIT 1";
    $row = robustSQLRow($sql, $conn);
    if (empty($row[0])) {
        return 0;
    } else {
        return $row[0];
    }
}

function findListName($table, $id, $conn) {
    // finds current list; if it doesn't exist, sets $listName as "LOCK" in list_of_lists_A
    $listName = "";
    $sql1 = "SELECT List_ID from $table";
    $row1 = robustSQLRow($sql1, $conn);
    if (!empty($row1)) {
        $listName = $row1[0];
    } else {
        $sql2 = "SELECT list_name FROM list_of_lists_A WHERE session_id = '$id'";
        $row2 = robustSQLRow($sql2, $conn);
        if (!empty($row2)) {
            $listName = $row2[0];
        } else {
            $sql3 = "SELECT list_name FROM list_of_lists_A WHERE Used = 'FALSE'";
            $row3 = robustSQLRow($sql3, $conn);
            if (!empty($row3)) {
                $listName = $row3[0];
            } else {
                $sql4 = "SELECT list_name FROM list_of_lists_A WHERE date !=0 ORDER by date ASC LIMIT 1";
                $row4 = robustSQLRow($sql4, $conn);
                $listName = $row4[0];
            }
            updateLOLA($listName, $id, $conn);
        }
    }
    return $listName;
}  

function updateListDate($listName, $responseFile, $conn) {
    $responseFile = str_replace(' ', '', $responseFile);
    $sql = "UPDATE $listName SET `Date`= NOW() WHERE fileName = '$responseFile'";
    robustRunSQL($sql, $conn);
}

function recordData($table, $listName, $id, $response, $responseFile, $conn) {
    // record response and standard line data to $table
    $sql = "INSERT INTO $table (Response, List_ID, fileName, Session_ID, date) VALUES('$response', '$listName', '$responseFile', '$id', NOW())";
    robustRunSQL($sql, $conn);
}

function findNextSen($listName, $conn) {
    $fname = "";
    $sql1 = "SELECT fileName from $listName where Date = '1900-01-01 00:01:00' ORDER by Sentence_ID ASC";
    $row1 = robustSQLRow($sql1, $conn);
    if (!empty($row1)) {
        $fname = $row1[0];
        $sql2 = "SELECT Used from $listName where fileName = '$fname'";
        $row2 = robustSQLRow($sql2, $conn);
        if ($row2[0] != 0) {
            $sql4 = "SELECT sentence_ID from $listName where fileName = '$fname'";
            $row4 = robustSQLRow($sql4, $conn);
            $sentence_ID = $row4[0];
            $sql6 = "UPDATE $listName SET `Used` = 0 where fileName = '$fname'";
            robustRunSQL($sql6, $conn);
            if ($sentence_ID < 120) {
                $nID = $sentence_ID +1;
                $sql5 = "SELECT fileName from $listName where sentence_ID = $nID";
                $row5 = robustSQLRow($sql5, $conn);
                $fname = $row5[0];
            } 
        }   
    } else {
        $fname = true;
    }
    $sql3 = "UPDATE $listName SET `Used` = 1 where fileName = '$fname'";
    robustRunSQL($sql3, $conn);
    return $fname;
}

function postProcessing($id, $conn) {
    $sql1 = "UPDATE biodata SET Completed = NOW() WHERE Session_ID = '$id'";
    robustRunSQL($sql1, $conn);
}
?>