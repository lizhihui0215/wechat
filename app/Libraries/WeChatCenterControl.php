<?php
  namespace App\Libraries;
  use GuzzleHttp\Client;
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
      $json =  json_decode($response->getBody());
      WeChatCenterControl::$ACCESS_TOKEN = $json->{'access_token'};
      return WeChatCenterControl::$ACCESS_TOKEN;
    }

  }
 ?>
