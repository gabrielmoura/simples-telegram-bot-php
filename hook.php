<?php
/**
 * @author Gabriel Moura <g@srmoura.com.br>
 * @copyright 2015-2017 SrMoura
 */

require("vendor/autoload.php");
use Blx32\database;
use Blx32\telegram;

$telegram = new Blx32\telegram\Telegram(array(
    'bot_id' => 'SEU_BOT_KEY',
    'adms' => array(),
    'folder_log' => __DIR__));
$db = new Blx32\database\Db(array(
    'dbtype'=>'mysql',
    'host' => 'localhost',
    'user' => 'user',
    'password' => 'password',
    'database' => 'database',
));

$text = $telegram->Text();
$chat_id = $telegram->ChatID();
$user_id = $telegram->UserID();

if (mb_substr($text, 0, 6) == "/teste") {
    $text_seg = trim(mb_substr($text, 6));
    $reply = "Sucesso!\nVocê digitou: ".$text_seg;
    $content = array('chat_id' => $chat_id, 'text' => $reply);
    $telegram->sendMessage($content);
}
