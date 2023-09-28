<?php

namespace App;

class Question1 {

    /*
        1) I should have used a light-weight framework like lumen. 
           This would have provided tighter coupling for generating dummy data for tests and abstracting tables to models and ORM.
           I would not normally do all this logic in __construct.
    */
    function __construct() {

        unlink('./mysqlitedb.sql');
        $db  = new \SQLite3(
            './mysqlitedb.sql'
        );

        $sql_CreateStudentTable = "CREATE TABLE student
        (id INTEGER PRIMARY KEY, name TEXT, address TEXT);";

        $sql_CreateApplicationTable = "CREATE TABLE application
        (id INTEGER PRIMARY KEY, student_id INTEGER REFERENCES student (id), score INTEGER);";

        $db->exec($sql_CreateStudentTable);
        $db->exec($sql_CreateApplicationTable);

        $db->exec("INSERT INTO student (id, name, address) VALUES (null,'John Smith', '1000 N. Vardon Rd.')");
        
        $db->exec("INSERT INTO student (id, name, address) VALUES (null,'Lee Gordon', '300 E. Gordon St.')");
        $studentId = $db->lastInsertRowID();
        $stmt = $db->prepare("INSERT INTO application (id, student_id, score) VALUES (null,:student_id,85)");
        $stmt->bindValue(':student_id', $studentId, SQLITE3_INTEGER);
        $stmt->execute();
    
        // the sql statement tested for
        $stmt = $db->prepare('SELECT student.id, student.name, count(application.id) FROM student LEFT JOIN application ON student.id = application.student_id GROUP BY student.id');
            
        $result = $stmt->execute();
        while($r = $result->fetchArray(SQLITE3_ASSOC)){
            $arr[] = $r;
        }
        print_r($arr);
    }
}

// var_dump(new Question1());
new Question1();