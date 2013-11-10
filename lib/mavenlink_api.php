<?php
if (!function_exists('curl_init')) {
    throw new Exception('Mavenlink PHP API Client requires the CURL PHP extension');
}

class MavenlinkApi {
    private static $devMode = true;
    private $loginInfo = null;

    function __construct($oauthToken, $production = true) {
        $this->loginInfo = $oauthToken;

        if ($production) {
            self::$devMode = false;
        }
    }

    function getJson($resourceName, $params) {
        $valid_resources = array("attachments", "expense_categories", "expenses", "invoices", "posts", "stories", "time_entries", "users", "workspaces");
        
        if (!in_array($resourceName, $valid_resources)) return;

        $path = $this->getBaseUri() . $resourceName .  '.json' . '?' . http_build_query($params);
        $curl = $this->getCurlHandle($path, $this->loginInfo);
        
        $json = curl_exec($curl);

        return $json;
    }

    function createNew($resourceName, $params) {
        $params = $this->labelParamKeys($resourceName, $params);

        $newPath = $this->getBaseUri() . $resourceName . 's';
        $curl     = $this->createPostRequest($newPath, $this->loginInfo, $params);
        $response = curl_exec($curl);

        return $response;
    }

    function update($resourceName, $params){
        $id = $params['id']; 
        unset($params['id']);
        $wrappedParams = $this->labelParamKeys($resourceName, $params);
        
        $updatePath = $this->getBaseUri() . $resourceName . 's/' . $id . '.json';
        $curl = $this->createPutRequest($updatePath, $this->loginInfo, http_build_query($wrappedParams));
        $response = curl_exec($curl);

        return $response;
    }

    function delete($resourceName, $resourceId ){
        $deletePath = $this->getBaseUri() . $resourceName . 's/' . $resourceId . '.json';
        $curl = $this->createDeleteRequest($deletePath, $this->loginInfo);
        $response = curl_exec($curl);

        return $response;
    }

    function wrapParamFor($apiObjectName, $arrayKey) {
        return strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1", "$apiObjectName") . "[$arrayKey]");
    }

    function labelParamKeys($apiObjectName, $paramsArray) {
        $labelledArray = array();

        foreach ($paramsArray as $key => $value) {

            if ($this->keyAlreadyWrapped($apiObjectName, $key)) {
                $wrappedKey = strtolower($key);
            }
            else {
                $wrappedKey = $this->wrapParamFor($apiObjectName, $key);
            }

            $labelledArray[$wrappedKey] = $value;
        }

        return $labelledArray;
    }

    function keyAlreadyWrapped($object, $key) {
        $object = strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1", "$object"));
        $matchPattern = "$object" . "\[\w+\]";
        $matchWrapped = 0;
        $matchWrapped = preg_match("/$matchPattern/", $key);

        return $matchWrapped == 1;
    }
  
    public static function getBaseUri() {
        return self::$devMode ? 'https://api.mavenlink.local/api/v1/' : 'https://api.mavenlink.com/api/v1/';
    }    


    function createPostRequest($url, $accessCredentials, $params) {
        $curlHandle = $this->getCurlHandle($url, $accessCredentials);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $params);

        return $curlHandle;
    }

    function createPutRequest($url, $accessCredentials, $params) {
        $curlHandle = $this->getCurlHandle($url, $accessCredentials);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $params);

        return $curlHandle;
    }

    function createDeleteRequest($url, $accessCredentials) {
        $curlHandle = $this->getCurlHandle($url, $accessCredentials);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, 'DELETE');

        return $curlHandle;
    }

    function getCurlHandle($url, $accessCredentials) {
        $curlOptions = array(
            CURLOPT_URL            => $url,
            CURLOPT_HTTPHEADER     => array('Authorization: Bearer ' . $accessCredentials),
            CURLOPT_RETURNTRANSFER => TRUE
        );

        $curlHandle = curl_init();
        curl_setopt_array($curlHandle, $curlOptions);

        if (self::$devMode) {
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 0);
        }

        return $curlHandle;
    }
}
?>