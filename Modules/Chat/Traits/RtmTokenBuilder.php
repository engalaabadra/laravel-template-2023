<?php
namespace Modules\Chat\Traits;

use Modules\Chat\Traits\Message;
class RtmTokenBuilder
{
  public $Privileges = array(
    "kJoinChannel" => 1,
    "kPublishAudioStream" => 2,
    "kPublishVideoStream" => 3,
    "kPublishDataStream" => 4,
    "kRtmLogin" => 1000,
);
    /**
    * @var Message
    */
    protected $Message;

    public function __construct( Message $Message)
    {
        $this->Message = $Message;
    }
  //  const RoleRtmUser = 1;
    # appID: The App ID issued to you by Agora. Apply for a new App ID from 
    #        Agora Dashboard if it is missing from your kit. See Get an App ID.
    # appCertificate:	Certificate of the application that you registered in 
    #                  the Agora Dashboard. See Get an App Certificate.
    # channelName:Unique channel name for the AgoraRTC session in the string format
    # userAccount: The user account. 
    # role: Role_Rtm_User = 1
    # privilegeExpireTs: represented by the number of seconds elapsed since 
    #                    1/1/1970. If, for example, you want to access the
    #                    Agora Service within 10 minutes after the token is 
    #                    generated, set expireTimestamp as the current 
    #                    timestamp + 600 (seconds)./
      public  function buildToken($appID, $appCertificate, $userAccount, $expireTimeSeconds){
        // Initialize the Agora RTC SDK
        $token = $this->Message->init($appID, $appCertificate, $userAccount);
         // Generate a token for the user
        $token->addPrivilege($this->Privileges["kRtmLogin"],  $expireTimeSeconds);
        return $token->build();
    }
}

