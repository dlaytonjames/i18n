<?php
/*
 * Copyright 2005-2013 the original author or authors.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once('../libs/common.php');
require_once('../libs/operator.php');
require_once('../libs/operator_settings.php');

$operator = check_login();

function update_operator_groups($operatorid, $newvalue)
{
	global $mysqlprefix;
	$link = connect();
	perform_query("delete from ${mysqlprefix}chatgroupoperator where operatorid = $operatorid", $link);
	foreach ($newvalue as $groupid) {
		perform_query("insert into ${mysqlprefix}chatgroupoperator (groupid, operatorid) values ($groupid,$operatorid)", $link);
	}
	close_connection($link);
}

$operator_in_isolation = in_isolation($operator);

$opId = verifyparam("op", "/^\d{1,9}$/");
$page = array('opid' => $opId);
$link = connect();
$page['groups'] = $operator_in_isolation?get_all_groups_for_operator($operator, $link):get_all_groups($link);
close_connection($link);
$errors = array();

$canmodify = is_capable($can_administrate, $operator);

$op = operator_by_id($opId);

if (!$op) {
	$errors[] = getlocal("no_such_operator");

} else if (isset($_POST['op'])) {

	if (!$canmodify) {
		$errors[] = getlocal('page_agent.cannot_modify');
	}

	if (count($errors) == 0) {
		$new_groups = array();
		foreach ($page['groups'] as $group) {
			if (verifyparam("group" . $group['groupid'], "/^on$/", "") == "on") {
				$new_groups[] = $group['groupid'];
			}
		}

		update_operator_groups($op['operatorid'], $new_groups);
		header("Location: $webimroot/operator/opgroups.php?op=$opId&stored");
		exit;
	}
}

$page['formgroup'] = array();
$page['currentop'] = $op ? topage(get_operator_name($op)) . " (" . $op['vclogin'] . ")" : "-not found-";
$page['canmodify'] = $canmodify ? "1" : "";

if ($op) {
	foreach (get_operator_groupids($opId) as $rel) {
		$page['formgroup'][] = $rel['groupid'];
	}
}

$page['stored'] = isset($_GET['stored']);
prepare_menu($operator);
setup_operator_settings_tabs($opId, 2);
start_html_output();
require('../view/operator_groups.php');
?>