<?php
/**
 * Jemena Course Report - Local library function
 *
 * @package     report_coursereport
 * @copyright   2017 Pukunui Technology
 * @author      Priya Ramakrishnan, Pukunui {@link http://pukunui.com}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
ini_set('max_execution_time', 500);
function report_coursereport_generate($courseid) {
	global $DB, $CFG;

	$sql = "SELECT 
		c.id as 'courseid',
                c.fullname as 'course',
		cgt.name as 'category',
		c.idnumber as 'ilt',
		c.summary as 'coursesummary',
		CASE WHEN c.ismandatory = '-1' THEN 'Not selected'
			WHEN c.ismandatory = '0' THEN 'Optional'
			WHEN c.ismandatory = '1' THEN 'Mandatory'
			END AS 'coursemandatory'
		FROM {course} c
		LEFT JOIN {course_categories} cgt ON cgt.id = c.category";
        if ($courseid) {
            $sql .= " WHERE c.id = $courseid ";
        }    
        $sql .= " ORDER BY 2,3,4";
        $records = $DB->get_records_sql($sql);

	// Generate report 
        $filename = clean_filename("coursereport.csv");
        @header('Content-Disposition: attachment; filename='.$filename);
        @header('Content-Type: text/csv');
        $csvhead =  get_string('courseid', 'report_coursereport').','.get_string('course', 'report_coursereport').','.
                    get_string('category', 'report_coursereport').','.get_string('ilt', 'report_coursereport').','.
                    get_string('coursesummary', 'report_coursereport').','.get_string('mandatory', 'report_coursereport');
        $csvhead .= "\r\n";
        echo $csvhead;
        $csvdata = array();
        foreach ($records as $r) {
           $csvdata = $r->courseid.',"'.$r->course.'","'.$r->category.'",'.$r->ilt.',"'.strip_tags($r->coursesummary).'",'.$r->coursemandatory."\r\n";
           echo $csvdata; 
        }
} 
