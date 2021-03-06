<?php
/**
 * Form - Jemena Course Report
 *
 * @package     report_coursereport
 * @copyright   2017 Pukunui Technology
 * @author      Priya Ramakrishnan, Pukunui {@link http://pukunui.com}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once("$CFG->libdir/formslib.php");
/**
 * Class coursereport_form extends moodleform
 */
class coursereport_form extends moodleform{
    /**
     * Function to define from elements
     */
    public function definition() {
        global $DB, $OUTPUT, $CFG;
        $mform =& $this->_form;
        $courselist = array();
        $courses = $DB->get_records_sql('SELECT id, fullname FROM {course} ORDER BY fullname');
        $courselist[0] = get_string('allcourses', 'report_coursereport');
        foreach ($courses as $c) {
           $courselist[$c->id] = $c->fullname; 
        }
        $mform->addElement('select', 'course', get_string('selectcourse', 'report_coursereport'), $courselist);
        $mform->addElement('submit', 'generate', get_string('generate', 'report_coursereport'));
    }
}
