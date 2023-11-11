<?php
namespace Modules\Chat\Traits;
use DateTime;
use DateTimeZone;
use Modules\Chat\Traits\AccessToken;

class Message
{
     /**
     * @var AccessToken
     */
    protected $AccessToken;

    public $salt;
    public $ts;
    public $privileges;
    public function __construct()
    {
        $this->salt = rand(0, 100000);

        $date = new DateTime("now", new DateTimeZone('UTC'));
        $this->ts = $date->getTimestamp() + 24 * 3600;

        $this->privileges = array(
            "kJoinChannel" => 1,
            "kPublishAudioStream" => 2,
            "kPublishVideoStream" => 3,
            "kPublishDataStream" => 4,
            "kRtmLogin" => 1000,
        );
    }

    public function init($appID, $appCertificate, $userAccount){
        $AccessToken=new AccessToken();
        return $AccessToken->init($appID, $appCertificate, $userAccount);
     }
    public function packContent()
    {
        $buffer = unpack("C*", pack("V", $this->salt));
        $buffer = array_merge($buffer, unpack("C*", pack("V", $this->ts)));
        $buffer = array_merge($buffer, unpack("C*", pack("v", sizeof($this->privileges))));
        foreach ($this->privileges as $key => $value) {
            $buffer = array_merge($buffer, unpack("C*", pack("v", $key)));
            $buffer = array_merge($buffer, unpack("C*", pack("V", $value)));
        }
        return $buffer;
    }

    public function unpackContent($msg)
    {
        $pos = 0;
        $salt = unpack("V", substr($msg, $pos, 4))[1];
        $pos += 4;
        $ts = unpack("V", substr($msg, $pos, 4))[1];
        $pos += 4;
        $size = unpack("v", substr($msg, $pos, 2))[1];
        $pos += 2;

        $privileges = array();
        for ($i = 0; $i < $size; $i++) {
            $key = unpack("v", substr($msg, $pos, 2));
            $pos += 2;
            $value = unpack("V", substr($msg, $pos, 4));
            $pos += 4;
            $privileges[$key[1]] = $value[1];
        }
        $this->salt = $salt;
        $this->ts = $ts;
        $this->privileges = $privileges;
    }
}
