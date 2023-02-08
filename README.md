## Clover PHP CardConnect API

## Overview 
The CardPointe Gateway API allows you to securely accept a wide-range of credit, debit, and alternative payments.  

## Setup ENV (Sandbox)
```php

CLOVER_SITE='isv-uat'
CLOVER_SITE_BASE_URL=https://isv-uat.cardconnect.com/
CLOVER_TOKENIZE_URL=https://isv-uat.cardconnect.com/cardsecure/api/v1/ccn/tokenize
CLOVER_MERCHANT_ID=123456123456
CLOVER_USER_NAME='username'
CLOVER_PASSWORD='password'
CLOVER_LOG=true // enable logs 

```

API documentation  https://developer.cardpointe.com/cardconnect-api
## Initializing
```php
$merchant_id = '123456123456';
$user        = 'username';
$pass        = 'password';
$server      = 'https://isv-uat.cardconnect.com';

$client = new CardPointe($merchant_id, $user, $pass, $server);
```

## Testing Credentials
```php
$boolean = $client->testAuth();
```

## Validate Merchant ID
```php
$boolean = $client->validateMerchantId();
```

## Tweaks
Responses are parsed and their amount fields are returned in cents ```int```.

The client stores the last request made as an ```array``` ```$client->last_request``` which can be used to debug requests

## Response Objects
Responses are returned as objects and can be accessed as arrays.
```php
$response = $client->inquire($retref);
$response->amount; // returns int
$response->toJSON(); // Returns JSON encoded string, accepts format codes (JSON_PRETTY_PRINT, etc)
$response->toArray(); // Returns array of attributes
```

## Authorizing Transactions
```php
$request = new AuthorizationRequest([
    'account' => '4242424242424242',
    'amount'  => '100',
    'expiry'  => '0120',
]);
$authorization_response = $client->authorize($request);
```

**You can also authorize and capture in the same request like so**
```php
$request = new AuthorizationRequest([
    'account' => '4111111111111111',
    'amount'  => '100',
    'expiry'  => '0124',
    'capture' => true,
    'profile' => true,
]);
$capture_response = $client->authorize($request);
```

**You can also authorize and capture in the same request using a saved card with PROFILE_ID/ACCOUNT_ID like so**
```php
$request = new AuthorizationRequest([
    'account' => '4111111111111111',
    'amount'  => '100',
    'expiry'  => '0124',
    'capture' => true,
    'profile' => "$profile_id/$account_id", // using a profile/account
]);
$capture_response = $client->authorize($request);
```

To view all available fields see [Authorization Request](https://developer.cardconnect.com/cardconnect-api#authorization-request)

All returned fields see [Authorization Response](https://developer.cardconnect.com/cardconnect-api#authorization-response)

## Capturing Transactions
```php
$auth_retref = '123456654321';
$params = []; // optional
$capture_response = $client->capture($auth_retref, $params);
```
To view all available fields see [Capture Request](https://developer.cardconnect.com/cardconnect-api#capture-request)

All returned fields see [Capture Response](https://developer.cardconnect.com/cardconnect-api#capture-response)

## Voiding Transactions
```php
$auth_retref = '123456654321';
$params = []; // optional
$void_response = $client->void($auth_retref, $params);
```
To view all available fields see [Void Request](https://developer.cardconnect.com/cardconnect-api#void-request)

All returned fields see [Void Response](https://developer.cardconnect.com/cardconnect-api#void-response)

## Refunding Transactions
```php
$capture_retref = '123456654321';
$params = []; // optional
$void_response = $client->refund($capture_retref, $params);
```
To view all available fields see [Refund Request](https://developer.cardconnect.com/cardconnect-api#refund-request)

All returned fields see [Refund Response](https://developer.cardconnect.com/cardconnect-api#refund-response)

## Transaction Status
```php
$retref = '123456654321';
$inquire_response = $client->inquire($retref);
```
All returned fields see [Inquire Response](https://developer.cardconnect.com/cardconnect-api#inquire-response)

## Settlement Status
```php
$date = '0118';
$settlements = $client->settleStat($date);
$first_settlement = $settlements[0];
```
All returned fields see [Settlement Response](https://developer.cardconnect.com/cardconnect-api#settlement-response)

## Create/Update Profile
```php
// update a profile by providing 'profile' => $profile_id in the request
$request = [
    'defaultacct' => true,
    'account'     => "4444333322221111",
    'expiry'      => "0914",
    'name'        => "Test User",
    'address'     => "123 Test St",
    'city'        => "TestCity",
    'region'      => "TestState",
    'country'     => "US",
    'postal'      => "11111",
];
$res = $client->createProfile($request);
```
All returned fields see [Create/Update Profile Request](https://developer.cardconnect.com/cardconnect-api?lang=php#create-update-profile-response)

## Get Profile
```php
$profile_id = '1023456789';
$account_id = null; // optional
$profile = $client->profile($profile_id, $account_id);
```
All returned fields see [Profile Response](https://developer.cardconnect.com/cardconnect-api?lang=php#get-profile-response)

## Delete Profile
```php
$profile_id = '1023456789';
$account_id = null; // optional
$profile = $client->deleteProfile($profile_id, $account_id);
```
All returned fields see [Delete Profile Response](https://developer.cardconnect.com/cardconnect-api?lang=php#delete-profile-response)


##  Tokenize ApplePay
```php
$this->client = new \Dewbud\CardConnect\CardPointe($this->merchant_id, $this->user, $this->pass, $this->server, $this->currency, true);
//"devicedata":"<data>&ectype=apple&ecsig=<signature>&eckey=<ephemeralPublicKey>&ectid=<transactionId>&echash=<applicationDataHash>&ecpublickeyhash=<publicKeyHash>"
$request = [
    "devicedata" => $deviceData // response you getting from apple pay authorized 
];

$response = $this->client->tokenizeApplePay($request);
```
Tokenizing Apple Pay using the CardSecure API [tokenize ApplePay](https://developer.cardpointe.com/guides/apple-pay#integrating-apple-pay-using-the-cardSecure-api)


##  Tokenize GooglePay
```php
$this->client = new \Dewbud\CardConnect\CardPointe($this->merchant_id, $this->user, $this->pass, $this->server, $this->currency, true);
//"devicedata" : "{\"signature\":\"MEYCIQCwmJRWgG8cT1et/SgjLXr8+dmZ2BZpiLEg/T474g2NZAIhAKVmDiozWuQoPED7qaGNDyoYslL2YzHSFM724Md89+33\",\"intermediateSigningKey\":{\"signedKey\":\"{\\\"keyValue\\\":\\\"MFkwEwYHKoZIzj0CAQYIKoZIzj0DAQcDQgAEgY3czp0xq5QW3NTQgYvmDJ2i+Oj3YtFwfXHed6ZjtDIju/FkfPIT66AOAAEIe2UqS8dTL/AZkM98KAp4LdekAQ\\\\u003d\\\\u003d\\\",\\\"keyExpiration\\\":\\\"1585761306143\\\"}\",\"signatures\":[\"MEYCIQDb+LBzB21jEBRr0r/RqH6QDoYWqpcY5nJFdFKIpNmB5QIhAN3RdiHK0bl6kBigXnIe8qUEnrGqdC6q5NQWJHwEhF12\"]},\"protocolVersion\":\"ECv2\",\"signedMessage\":\"{\\\"encryptedMessage\\\":\\\"mJVt1VLA/CJMosu8s/C3ixVgNHW3ZuJSBx4mSU8HbQtB1Ll9jV0jgeSZ9CVnmCr9w9RiPKvdo1mJGz69aNky4oYMKt/2gUWsRDMKf0LOktjYQ9kLUpyJvkX5YGrwkeL12qUceIYcMX84L+tlV+FVVfhCcxsDNWKnKSxqzP5/KAN3is6YQ5YnTxfz7xEVXTFoAHv78XBowQq2GSioK7uV2MubHO+o5+G5+i/OJBNMsZevM27nE8gO5OQUOugkX7/cLbFHYlvJEpy7rWHj7yUV9r7eeji2uC0cKorOGdgoFjY6Hax8gtwiBJM56TlkChOA6JI8e3pO5a3r+ZkSMB95c/lAOSbesush02KNvIAKan5A6435mQ7VnQK3FJcX3s7cGO0yP2FHnbki+Oewzfoix1tNg1WuNiPXk2Cn1IM4cvk+GErEqDG1Uqh1KGb/P4F/bBDtwiqKR8FP/1dIVtgj8gi/sRG55Nm+SfRIprXv3g\\\\u003d\\\\u003d\\\",\\\"ephemeralPublicKey\\\":\\\"BK9KRSzyuwWyy9LUh2S2ue7M02xheyVtn42plZb6bp0EhZUyu0iL0QsvDsczs2fPGtJ3h0GsC9NE1Oa0BbMoIHs\\\\u003d\\\",\\\"tag\\\":\\\"KVHidXy9urg15Sjw/DeibMgxuqw73VajbEN/NZ7YEik\\\\u003d\\\"}\"}"
$request = [
    "devicedata" => $deviceData // response you getting from google pay authorized 
];

$response = $this->client->tokenizeGooglePay($request);
```
Tokenizing Google Pay Data using the CardSecure API [tokenize GooglePay](https://developer.cardpointe.com/guides/google-pay#integrating-the-google-pay-api)


## Tests
```composer test```

Note: small or large authorization/capture amounts don't seem to work with the test merchant credentials.

Special Thanks

1) [LAYOUTindex](https://www.layoutindex.co.uk/)
2) [Dewbud\CardConnect](https://github.com/Dewbud)

