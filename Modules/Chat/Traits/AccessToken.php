<?php
namespace Modules\Chat\Traits;
use Modules\Chat\Traits\Message;
class AccessToken
{
      /**
     * @var Message
     */
    protected $message;
    public $appID, $appCertificate, $channelName, $uid;

    function setUid($uid)
    {
        if ($uid === 0) {
            $this->uid = "";
        } else {
            $this->uid = $uid . '';
        }
    }

    public function is_nonempty_string($name, $str)
    {
        if (is_string($str) && $str !== "") {
            return true;
        }
        echo $name . " check failed, should be a non-empty string";
        return false;
    }
    

    public  function init($appID, $appCertificate, $userAccount)
    {
        if (!$this->is_nonempty_string("appID", $appID) ||
            !$this->is_nonempty_string("appCertificate", $appCertificate) 
           // ||!$this->is_nonempty_string("channelName", $channelName)
            ) {
                return null;
            }
            
            $this->appID = $appID;
        $this->appCertificate = $appCertificate;
        // $this->channelName = $channelName;

        $this->setUid($this->uid);
        return $this;
    }

    static function initWithToken($token, $appCertificate, $channel, $uid)
    {
        $accessToken = new AccessToken();
        if (!$accessToken->extract($token, $appCertificate, $channel, $uid)) {
            return null;
        }
        return $accessToken;
    }

    function addPrivilege($key, $expireTimestamp)
    {
        
    
        $privileges[$key] = $expireTimestamp;
        return $this;
    }

    function extract($token, $appCertificate, $channelName, $uid)
    {
        $ver_len = 3;
        $appid_len = 32;
        $version = substr($token, 0, $ver_len);
        if ($version !== "006") {
            echo 'invalid version ' . $version;
            return false;
        }

        if (!$this->is_nonempty_string("token", $token) ||
            !$this->is_nonempty_string("appCertificate", $appCertificate) ||
            !$this->is_nonempty_string("channelName", $channelName)) {
            return false;
        }

        $appid = substr($token, $ver_len, $appid_len);
        $content = (base64_decode(substr($token, $ver_len + $appid_len, strlen($token) - ($ver_len + $appid_len))));

        $pos = 0;
        $len = unpack("v", $content . substr($pos, 2))[1];
        $pos += 2;
        $sig = substr($content, $pos, $len);
        $pos += $len;
        $crc_channel = unpack("V", substr($content, $pos, 4))[1];
        $pos += 4;
        $crc_uid = unpack("V", substr($content, $pos, 4))[1];
        $pos += 4;
        $msgLen = unpack("v", substr($content, $pos, 2))[1];
        $pos += 2;
        $msg = substr($content, $pos, $msgLen);

        $this->appID = $appid;
        $message = new Message();
        $message->unpackContent($msg);
        $this->message = $message;

        //non reversable values
        $this->appCertificate = $appCertificate;
        $this->channelName = $channelName;
        $this->setUid($uid);
        return true;
    }

    function build()
    {
        $message= new Message();
        $msg = $message->packContent();
        $val = array_merge(unpack("C*", $this->appID), unpack("C*", $this->channelName), unpack("C*", $this->uid), $msg);

        $sig = hash_hmac('sha256', implode(array_map("chr", $val)), $this->appCertificate, true);

        $crc_channel_name = crc32($this->channelName) & 0xffffffff;
        $crc_uid = crc32($this->uid) & 0xffffffff;

        $content = array_merge(unpack("C*", packString($sig)), unpack("C*", pack("V", $crc_channel_name)), unpack("C*", pack("V", $crc_uid)), unpack("C*", pack("v", count($msg))), $msg);
        $version = "006";
        $ret = $version . $this->appID . base64_encode(implode(array_map("chr", $content)));
        return $ret;
    }
}

function packString($value)
{
    return pack("v", strlen($value)) . $value;
}