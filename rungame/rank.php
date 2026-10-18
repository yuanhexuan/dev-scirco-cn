<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

$file = __DIR__ . "/rank.txt";
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}
$raw = file_get_contents($file);
$rankList = json_decode($raw, true) ?: [];
$action = $_GET['act'] ?? '';

// 脏话/敏感词库（可自己继续加）
$bad_words = [
    '傻逼', '操', '妈的', '尼玛', '废物', '垃圾', '去死', '草',
    'fuck', 'shit', 'bitch', 'nigger', '傻缺', '憨批', '滚', '畜生',
    'gay','sb','cnm','78','91'
];

if ($action === 'save') {
    $nick = trim($_POST['nick'] ?? '');
    $score = intval($_POST['score'] ?? 0);
    if (empty($nick) || $score <= 0) {
        echo json_encode(['code' => 0, 'msg' => '昵称或分数无效'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // 脏话过滤
    $found_bad = false;
    foreach ($bad_words as $w) {
        if (mb_stripos($nick, $w) !== false) {
            $found_bad = true;
            break;
        }
    }
    if ($found_bad) {
        echo json_encode(['code' => 0, 'msg' => '昵称包含不当内容，请修改'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // 长度限制
    if (mb_strlen($nick) > 10) {
        echo json_encode(['code' => 0, 'msg' => '昵称最长10个字符'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $rankList[] = [
        'nick' => $nick,
        'score' => $score,
        'time' => date('Y-m-d H:i:s')
    ];
    usort($rankList, fn($a, $b) => $b['score'] - $a['score']);
    $rankList = array_slice($rankList, 0, 30);
    file_put_contents($file, json_encode($rankList, JSON_UNESCAPED_UNICODE));
    echo json_encode(['code' => 1, 'msg' => '保存成功'], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($action === 'get') {
    $top10 = array_slice($rankList, 0, 10);
    echo json_encode(['code' => 1, 'data' => $top10], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode(['code' => 0, 'msg' => '非法请求'], JSON_UNESCAPED_UNICODE);
?>