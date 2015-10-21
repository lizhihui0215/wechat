<?php
  namespace App\Libraries;
  use Log;
  use GuzzleHttp\Client;
  use Nathanmac\Utilities\Parser\Parser;
  /**
   *
   */
  class WeChatCenterControl
  {

    const TOKEN = "wechattokentest";

    public static $ACCESS_TOKEN = "";

    public static $APP_ID = "wx072a790e476d9976";

    public static $APP_SECRET = "f17280fe3b04d8a4cae8b95db106ea76";

    public static function request_access_token()
    {

      // https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET
      $client = new Client();
      $response = $client->request('GET','https://api.weixin.qq.com/cgi-bin/token',[
          'query' =>[ 'grant_type' => 'client_credential',
                      'appid' => WeChatCenterControl::$APP_ID,
                      'secret' => WeChatCenterControl::$APP_SECRET
                    ]
        ]);
      $access_token =  json_decode($response->getBody())->{'access_token'};
      return $access_token;
    }

    public function getAccessToken($isReload=false){
      if (!$isReload) return self::$ACCESS_TOKEN;

    }

    public static function validationSignature($signature, $array)
    {
      if (!WeChatCenterControl::TOKEN) {
        throw new Exception('TOKEN is not defined!');
      }
      $array[] = WeChatCenterControl::TOKEN;
      sort($array, SORT_STRING);
      $tmpStr = implode($array);
      $tmpStr = sha1($tmpStr);
      return $signature == $tmpStr;
    }

    public static function dispatchMessage($content)
    {

      $parser = new Parser();
      $contentArray = $parser->xml($content);
      switch ($contentArray['MsgType']) {
        case 'text':
          $message = new WeChatMessage();
          break;

        default:
          # code...
          break;
      }
      Log::info("dispatchMessage " ,[
                                  $content,
                                  $contentArray['ToUserName']
                                  ]);
    }

  }
 ?>
