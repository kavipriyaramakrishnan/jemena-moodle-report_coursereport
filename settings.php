<?php
/**
 * Jemena Course Report - Settings
 *
 * @package     report_coursereport
 * @copyright   2017 Pukunui Technology
 * @author      Priya Ramakrishnan, Pukunui {@link http://pukunui.com}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

$ADMIN->add('reports', new admin_externalpage('report_coursereport', get_string('pluginname', 'report_coursereport'),
            "$CFG->wwwroot/report/coursereport/index.php", 'reports/coursereport:view'));

