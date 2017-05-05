Bem Vindo ao Simples TelegramBot
===================


Espero ajudar pessoas com baixíssimo conhecimento em PHP deixando tudo o mais fácil possivel.

----------


## Instrução de uso.

Após criar o cadastro do bot no [@botfather](tg://resolve?domain=botfather), você precisará copiar todo o conteúdo da pasta e por numa pasta secreta em seu site.
 Vamos as exigências:
 - PHP 7
 - SSL
 
 Quanto ao SSL podemos contornar isso hospedando no [Heroku](https://herokuaap.com), ou configurando o [CloudFlare](https://cloudflare.com) no seu site.

##Funcionamento
O funcionamento é bem simples, quando o usuário passa um texto para o nosso bot ele verifica se nesse texto tem um comando e executa uma ação. Essa ação é enviada ao API do telegram, podendo ser um texto, imagens, documentos , localização e afins.

##Mão na massa
Ponha o nome no seu hook como desejar

    require("vendor/autoload.php");
    use Blx32\telegram;
    
    $telegram = new Blx32\telegram\Telegram(array(
        'bot_id' => 'SEU_BOT_KEY',
        'adms' => array(),
        'folder_log' => __DIR__));
    
    
    $text = $telegram->Text();
    $chat_id = $telegram->ChatID();
    $chat_id_adm = array('name' => 'user_id');
    
    if (mb_substr($text, 0, 6) == "/teste") {
    $text_seg = trim(mb_substr($text, 6));
    $reply = "Sucesso!\nVocê digitou: ".$text_seg;
    $content = array('chat_id' => $chat_id, 'text' => $reply);
    $telegram->sendMessage($content);
    }
Este é um exemplo simples do que pode ser feito.

##Ativação
Para que ele funcione é preciso dizer ao Telegram onde esta hospedado sua aplicação. Para isso digite em seu navegador:

    https://api.telegram.org/bot(BOT_KEY)/setwebhook?url=(URL)

Sendo URL: `https://seu_site.com.br/_pasta_secreta_/nome_dado_ao_hook.php`
