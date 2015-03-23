<?php

class ReportDB {

    // ------ Get All Unresolved Reports ------ //

     public static function getUnresolvedReports(){

        $db = Database::getDB();

        $query = "SELECT * FROM reports 
                WHERE resolved = 0";

        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $reports = array();

        foreach ($result as $row) {
            $report = new Report(
                $row['reporter_id'],
                $row['reported_id'],
                $row['reported_proj']);
            $report->setID($row['report_id']);
            $reports[] = $report;
        }

        return $reports;
    }

    // ------ Get All Resolved Reports ------ //

     public static function getResolvedReports(){

        $db = Database::getDB();

        $query = "SELECT * FROM reports 
                WHERE resolved = 1";

        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $reports = array();

        foreach ($result as $row) {
            $report = new Report(
                $row['reporter_id'],
                $row['reported_id'],
                $row['reported_proj']);
            $report->setID($row['report_id']);
            $reports[] = $report;
        }

        return $reports;
    }

    // ------ Get All Reporters ------ //

     public static function getReporters(){

        $db = Database::getDB();

        $query = "SELECT report_id DISTINCT(reporter_id) AS reporter, reported_id, COUNT(*) AS num_reported 
                    FROM reports 
                    GROUP BY reporter_id 
                    ORDER BY report_id DESC";

        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $reports = array();

        foreach ($result as $row) {

            $report = ["reporter"=>$row['reporter'], 
                       "num_reported"=>$row['num_reported']];

            $reports[] = $report;
        }

        return $reports;
    }

    // ------ Get All Reported ------ //

     public static function getReported(){

        $db = Database::getDB();

        $query = "SELECT report_id, reporter_id, DISTINCT(reported_id) AS reported, COUNT(*) AS num_reported 
                    FROM reports 
                    GROUP BY reported_id 
                    ORDER BY report_id DESC";

        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $reports = array();

        foreach ($result as $row) {

            $report = ["reported"=>$row['reported'], 
                       "num_reported"=>$row['num_reported']];

            $reports[] = $report;
        }

        return $reports;
    }

    // ------ Get A Report By ID ------ //
    
    public static function getReportById($report_id){

        $db = Database::getDB();

        $query = "SELECT * FROM reports 
                  WHERE report_id = :report_id";

        $stm = $db->prepare($query);
        $stm->bindParam(":report_id", $report_id, PDO::PARAM_INT);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);

        $report = new Report(
            $row['reporter_id'],
            $row['reported_id'],
            $row['reported_proj']);
        $report->setID($row['report_id']);

        return $report;
    }

    // ------ Insert A Report ------ //

    public static function insertReport($report){

        $db = Database::getDB();

        $reporter_id = $report->getReporter();
        $reported_id = $report->getReported();
        $reported_proj = $report->getReportedProj();

        $query = "INSERT INTO reports
                   (reporter_id, 
                    reported_id, 
                    reported_proj) 
                    VALUES(
                        '$reporter_id', 
                        '$reported_id', 
                        '$reported_proj' 
                        )";

        $stm = $db->prepare($query);
        
        $row_count = $stm->execute();
        return $row_count;
    }

    // ------ Update A Report ------ //

    public static function updateReport($report, $report_id){

        $db = Database::getDB();

        $reporter_id = $report->getReporter();
        $reported_id = $report->getReported();
        $reported_proj = $report->getReportedProj();

        $query = "UPDATE reports SET 
                    reporter_id = '$reporter_id',
                    reported_id = '$reported_id',
                    reported_proj = '$reported_proj'
                    WHERE report_id = :report_id";

        $stm = $db->prepare($query);
        $stm->bindParam(":report_id", $report_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        
        return $row_count;    
    }

    // ------ Resolve A Report ------ //

    public static function resolveReport($report_id){

        $db = Database::getDB();

        $query = "UPDATE reports SET 
                    resolved = 1
                    WHERE report_id = :report_id";

        $stm = $db->prepare($query);
        $stm->bindParam(':report_id', $report_id, PDO::PARAM_INT);
        $row_count = $stm->execute();

        return $row_count;
    }  

    // ------ Unresolve A Report ------ //

    public static function unresolveReport($report_id){

        $db = Database::getDB();

        $query = "UPDATE reports SET 
                    resolved = 0
                    WHERE report_id = :report_id";

        $stm = $db->prepare($query);
        $stm->bindParam(':report_id', $report_id, PDO::PARAM_INT);
        $row_count = $stm->execute();

        return $row_count;
    }  

    // ------ Delete A Report ------ //

    public static function deleteReport($report_id){

        $db = Database::getDB();

        $query = "DELETE FROM reports WHERE report_id = :report_id";

        $stm = $db->prepare($query);
        $stm->bindParam(':report_id', $report_id, PDO::PARAM_INT);
        $row_count = $stm->execute();

        return $row_count;
    }   

}
