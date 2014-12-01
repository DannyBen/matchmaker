<?php
namespace matchmaker;
require_once('matcher.php');

/**
 * Matches $object against $schema and returns array of failed fields
 *
 * @param $object
 * @param $schema
 *
 * @return array
 *
  */
function matches_verbose($object, $schema)
{
    $errors = [];
    foreach ($schema as $field=>$rule) {
        if (substr($field, -1) == "!") {
            $field = substr($field, 0, -1);
        }
        else if (substr($field, -1) == "?") {
            $field = substr($field, 0, -1);
            if (!isset($object[$field])) continue;
        }
        $result = matcher($object[$field], $rule);
        if (!$result) {
            $errors[] = ["field" => $field, "value" => $object[$field], "rule" => $rule];
        }
    }
    return $errors;
}
