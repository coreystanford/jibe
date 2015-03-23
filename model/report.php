<?php

class Report {

	private $report_id, $reporter_id, $reported_id, $reported_proj, $resolved;

	public function __construct($reporter_id, $reported_id, $reported_proj = null, $resolved = 0){
		$this->reporter_id = $reporter_id;
		$this->reported_id = $reported_id;
        $this->reported_proj = $reported_proj;
        $this->resolved = $resolved;
	}

	public function getID() {
        return $this->report_id;
    }

    public function setID($value) {
        return $this->report_id = $value;
    }

    public function getReporter() {
        return $this->reporter_id;
    }

    public function setReporter($value) {
        return $this->reporter_id = $value;
    }

    public function getReported() {
        return $this->reported_id;
    }

    public function setReported($value) {
        return $this->reported_id = $value;
    }

    public function getReportedProj() {
        return $this->reported_proj;
    }

    public function setReportedProj($value) {
        return $this->reported_proj = $value;
    }

    public function getResolved() {
        return $this->resolved;
    }

    public function setResolved($value) {
        return $this->resolved = $value;
    }

}
