<?php
    require_once __DIR__ . '/fb/src/Facebook/autoload.php';
    if (!session_id()) {
    session_start();
}
    $fb = new Facebook\Facebook([
    'app_id' => '1564307063870897', // Replace {app-id} with your app id
    'app_secret' => '8c71460b89a915bc85f77129f7a21e17',
    'default_graph_version' => 'v2.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    try 
    {
        $accessToken = $helper->getAccessToken();
    } 
    catch(Facebook\Exceptions\FacebookResponseException $e) 
    {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } 
    catch(Facebook\Exceptions\FacebookSDKException $e) 
    {
        // When validation fails or other local issues
        echo 'accessToken:'.$accessToken.'<br>';
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    if (! isset($accessToken)) 
    {
        if ($helper->getError()) 
        {
            header('HTTP/1.0 401 Unauthorized');
            echo "Error: " . $helper->getError() . "\n";
            echo "Error Code: " . $helper->getErrorCode() . "\n";
            echo "Error Reason: " . $helper->getErrorReason() . "\n";
            echo "Error Description: " . $helper->getErrorDescription() . "\n";
        } 
        else 
        {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
        }
        exit;
    }

    // Logged in
    //echo '<h3>Access Token</h3>';
    //var_dump($accessToken->getValue());

    // The OAuth 2.0 client handler helps us manage access tokens
    $oAuth2Client = $fb->getOAuth2Client();

    // Get the access token metadata from /debug_token
    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
    //echo '<h3>Metadata</h3>';
    //var_dump($tokenMetadata);

    // Validation (these will throw FacebookSDKException's when they fail)
    $tokenMetadata->validateAppId('1564307063870897'); // Replace {app-id} with your app id
    // If you know the user ID this access token belongs to, you can validate it here
    //$tokenMetadata->validateUserId('123');
    $tokenMetadata->validateExpiration();

    if (! $accessToken->isLongLived()) 
    {
        // Exchanges a short-lived access token for a long-lived one
        try 
        {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        } 
        catch (Facebook\Exceptions\FacebookSDKException $e) 
        {
            echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
            exit;
        }

        //echo '<h3>Long-lived</h3>';
        var_dump($accessToken->getValue());
    }

    $_SESSION['fb_access_token'] = (string) $accessToken;
    if (isset($accessToken)) 
    {
        $fb->setDefaultAccessToken($accessToken);
        try 
        {
          $requestProfile = $fb->get("/me?fields=name,email", $accessToken);
          $profile = $requestProfile->getGraphNode()->asArray();
        } 
        catch(Facebook\Exceptions\FacebookResponseException $e) 
        {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
        } 
        catch(Facebook\Exceptions\FacebookSDKException $e) 
        {
          // When validation fails or other local issues
            echo 'NAME:'.$profile['name'];
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        //echo 'NAME:'.$profile['name'].'<br>';
        //echo 'ID'.$profile['id'].'<br>';
        //echo 'EMAIL'.$profile['email'].'<br>';
        //echo 'FNAME'.$profile['firstname'].'<br>';
        //echo 'LNAME'.$profile['lastname'].'<br>';
        //echo 'MNAME'.$profile['middlename'].'<br>';

        $_SESSION['name'] = $profile['name'];
        $_SESSION['email'] = $profile['email'];

        /*$_SESSION['firstname'] = $profile['firstname'];
        $_SESSION['lastname'] = $profile['lastname'];
        $_SESSION['middlename'] = $profile['middlename'];
        */
        if(isset($_GET["tipo"]) && $_GET["tipo"]==0)
          $url='doRegisterAndLogin.php';
        else if(isset($_GET["tipo"]) && $_GET["tipo"]==1)
          $url='doLogin.php';
        header("Location:$url"); 
        //exit;
    } 
    else 
    {
        echo "Unauthorized access!!!";
        exit;
    }

    // User is logged in with a long-lived access token.
    // You can redirect them to a members-only page.
    //header('Location: https://example.com/members.php');

?>