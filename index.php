<?php
/**
 * Jemena Course Report
 *
 * @package     report_coursereport
 * @copyright   2017 Pukunui Technology
 * @author      Priya Ramakrishnan, Pukunui {@link http://pukunui.com}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once('../../config.php');
require_once($CFG->dirroot.'/report/coursereport/locallib.php');
require($CFG->dirroot.'/report/coursereport/coursereport_form.php');

require_login();
$systemcontext = context_system::instance();
$url = new moodle_url('/report/coursereport/index.php');
$strtitle = get_string('pluginname', 'report_coursereport');
// Set up PAGE object.
$PAGE->set_url($url);
$PAGE->set_context($systemcontext);
$PAGE->set_title($strtitle);
$PAGE->set_pagelayout('report');
$PAGE->set_heading($strtitle);

// Load up the form.
$mform = new coursereport_form();

// Process the data.
if ($data = $mform->get_data()) {
    $courseid = 0;
    if (!empty($data->generate)) {
        if ($data->course) {
            $courseid = $data->course;
        }
        report_coursereport_generate($courseid);
        exit;
    }
}
// Form & header Output.
echo $OUTPUT->header();
echo $mform->display();
echo $OUTPUT->footer();
