<?php

require_once( 'wp-load.php');

global $wpdb;

// 1. 사용자의 NAME (display name) 가져오기
$current_user = wp_get_current_user();
$user_name = $current_user->display_name;

// 2. wp_frmt_form_entry_meta에서 NAME과 대응하는 entry_id 찾기 
$query = $wpdb->prepare("
    SELECT entry_id
    FROM {$wpdb->prefix}frmt_form_entry_meta
    WHERE meta_value = %s
", $user_name);
$entry_ids = $wpdb->get_col($query);

// 3. entry_id에 대응하는 meta_key 가져오기 

$entry_ids_str = implode(', ',  $entry_ids);

$query = $wpdb->prepare("
    SELECT entry_id,
           GROUP_CONCAT(meta_key) AS meta_keys,
           GROUP_CONCAT(meta_value) AS meta_values
    FROM {$wpdb->prefix}frmt_form_entry_meta
    WHERE entry_id IN ($entry_ids_str)
      AND meta_key LIKE 'radio-%'
      AND meta_value IS NOT NULL
    GROUP BY entry_id
");

$results = $wpdb->get_results($query);


$labels = array(); // radio 배열 정의 
$data = array(); // mata_key 데이터 배열 정의

// 결과에서 meta_key를 추출하여 labels 배열에 추가
foreach ($results as $result) {
    $keys = explode(',', $result->meta_keys);
    foreach ($keys as $key) {
        $labels[] = trim($key);
    }

    $values = explode(',', $result->meta_values);
    $user_data = array();
    foreach ($values as $value) {
        // 맨 앞 숫자만 추출하여 저장
        preg_match('/\d/', $value, $matches);
        if (!empty($matches[0])) {
            $data[] = $matches[0];
        }
    }
}

// 데이터를 JSON으로 변환합니다.
$data = json_encode($data);

?>

