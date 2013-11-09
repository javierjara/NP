<?php


try {
  // include the LinkedIn class
  require_once('linkedin_2.1.0.class.php');
  
  // start the session
  session_start();
  
  // script constants
  define('UPDATE_COUNT', 10);
  //echo $_GET['callbackUrl'];
//$callback_url = $_GET['callbackUrl']. linkedin_API::_GET_TYPE . '_initiate/' . linkedin_API::_GET_RESPONSE . '_1';
//echo $callback_url;
  // set index
  $_REQUEST[linkedin_API::_GET_TYPE] = (isset($_REQUEST[linkedin_API::_GET_TYPE])) ? $_REQUEST[linkedin_API::_GET_TYPE] : 'initiate';
  switch($_REQUEST[linkedin_API::_GET_TYPE]) {
    case 'comment':
      $OBJ_linkedin = new linkedin_API();
      $OBJ_linkedin->set_token_access($_SESSION['oauth']['linkedin']['access']);
      //print_r($_POST);
      if(!empty($_POST['nkey'])) {
        $response = $OBJ_linkedin->comment($_POST['nkey'], $_POST['scomment']);
        if($response['success'] === TRUE) {
          // comment posted
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // problem with comment
          echo "Error commenting on update:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
        }
      } else {
        echo "You must supply a network update key to comment on an update.";
      }
      break;
    case 'initiate':
      // user initiated LinkedIn connection
      
      // create the linkedin object
      //$callback_url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '?' . linkedin_API::_GET_TYPE . '=initiate&' . linkedin_API::_GET_RESPONSE . '=1';
	  //$callback_url = 'http://' . $_SERVER['SERVER_NAME'] . '?' . linkedin_API::_GET_TYPE . '=initiate&' . linkedin_API::_GET_RESPONSE . '=1';
	  $callback_url = $_GET['callbackUrl']. linkedin_API::_GET_TYPE . '_initiate/' . linkedin_API::_GET_RESPONSE . '_1';
      //echo $callback_url;
      $OBJ_linkedin = new linkedin_API($callback_url);
      
      // check for response from LinkedIn
      $_GET[linkedin_API::_GET_RESPONSE] = (isset($_GET[linkedin_API::_GET_RESPONSE])) ? $_GET[linkedin_API::_GET_RESPONSE] : '';
      if(!$_GET[linkedin_API::_GET_RESPONSE]) {
        // LinkedIn hasn't sent us a response, the user is initiating the connection
        
        // send a request for a LinkedIn access token
        $response = $OBJ_linkedin->token_request();//die();
        if($response['success'] === TRUE) {
          // split up the response and stick the LinkedIn portion in the user session
          $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];
          
          // redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
          header('Location: ' . linkedin_API::_URL_AUTH . $_SESSION['oauth']['linkedin']['request']['oauth_token']);
          //$_SESSION['obj_linkedin'] = $OBJ_linkedin; 
        } else {
			
		    if ( isset($response['linkedin']['oauth_problem']) && $response['linkedin']['oauth_problem'] == 'timestamp_refused')
			  {
				  $tmp = (int)$response['linkedin']['oauth_acceptable_timestamps'];
				  $_SESSION['delta_time_stamp'] = $tmp-time();
				  
				  $response = $OBJ_linkedin->token_request();//die();
				  if($response['success'] === TRUE) {
				  // split up the response and stick the LinkedIn portion in the user session
				  $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];
				  
				  // redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
				  header('Location: ' . linkedin_API::_URL_AUTH . $_SESSION['oauth']['linkedin']['request']['oauth_token']);
				  //$_SESSION['obj_linkedin'] = $OBJ_linkedin; 
				}
				  
			  }
				  // bad token request
				//  echo "Bad request token call:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
        }
      } else {
        // LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
       
        $response = $OBJ_linkedin->token_access($_GET['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
        if($response['success'] === TRUE) {
          // the request went through without an error, gather user's 'access' tokens
          $_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];
          
          // set the user as authorized for future quick reference
          $_SESSION['oauth']['linkedin']['authorized'] = TRUE;
            
          // now we have the session 'access' tokens, request the linkedin id for the user and store that with keys in SESSION
          $response = $OBJ_linkedin->profile('~:(id)');
          if($response['info']['http_code'] == 200) {
            // data request using user's access keys successful, store data and send user back to demo page
  
            /** 
             * Use SimpleXMLElement to convert the XML response from the previous 
             * LinkedIn->profile() call into an object and store the LinkedIn
             * user ID for future reference.
             * 
             * http://php.net/manual/en/book.simplexml.php
             * 
             * NOTE: we need to cast the LinkedIn ID explicitly to a string as 
             * there are known issues with SimpleXMLElement treating the XML 
             * object as a resource, which breaks the SESSION's ability to store 
             * the data properly.                                            
             */
            if(class_exists('SimpleXMLElement')) {          
              $response['linkedin'] = new SimpleXMLElement($response['linkedin']);
              $_SESSION['oauth']['linkedin']['id'] = (string)$response['linkedin']->id;
            } else {
              echo "Missing SimpleXMLElement class...  please install this extension or use a different method to process the XML response.";            
            }
  
            // redirect the user back to the demo page
            header('Location: ' . $_SERVER['PHP_SELF']);
          } else {
            // bad data returned from LinkedIn get call
            echo "Bad get data returned:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
          }
        } else {
          // bad token access
          echo "Bad access token call:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
        }
      }
      break;
    case 'invite':
      // invitation messaging
      $OBJ_linkedin = new linkedin_API();
      $OBJ_linkedin->set_token_access($_SESSION['oauth']['linkedin']['access']);
      if(!empty($_POST['invite_to_id'])) {
        // send invite via LinkedIn ID
        $response = $OBJ_linkedin->invite('id', $_POST['invite_to_id'], $_POST['invite_subject'], $_POST['invite_body']);
        if($response['success'] === TRUE) {
          // message has been sent
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // an error occured
          echo "Error sending invite:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
        }
      } elseif(!empty($_POST['invite_to_email'])) {
        // send invite via email
        $recipient = array('email' => $_POST['invite_to_email'], 'first-name' => $_POST['invite_to_firstname'], 'last-name' => $_POST['invite_to_lastname']);
        $response = $OBJ_linkedin->invite('email', $recipient, $_POST['invite_subject'], $_POST['invite_body']);
        if($response['success'] === TRUE) {
          // message has been sent
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // an error occured
          echo "Error sending invite:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
        }
      } else {
        // no email or id supplied
        echo "You must supply an email address or LinkedIn ID to send out the invitation to connect.";
      }
      break;
    case 'like':
      $OBJ_linkedin = new linkedin_API();
      $OBJ_linkedin->set_token_access($_SESSION['oauth']['linkedin']['access']);
      if(!empty($_GET['nKey'])) {
        $response = $OBJ_linkedin->like($_GET['nKey']);
        if($response['success'] === TRUE) {
          // update 'liked'
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // problem with 'like'
          echo "Error 'liking' update:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
        }
      } else {
        echo "You must supply a network update key to 'like' an update.";
      }
      break;
    case 'message':
      // connection messaging
      if(!empty($_POST['connections'])) {
        $OBJ_linkedin = new linkedin_API();
        $OBJ_linkedin->set_token_access($_SESSION['oauth']['linkedin']['access']);
        
        if(!empty($_POST['message_copy'])) {
          $copy = TRUE;
        } else {
          $copy = FALSE;
        }
        $response = $OBJ_linkedin->message($_POST['connections'], $_POST['message_subject'], $_POST['message_body'], $copy);
        if($response['success'] === TRUE) {
          // message has been sent
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // an error occured
          echo "Error sending message:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
        }
      } else {
        echo "You must select at least one recipient.";
      }
      break;
    case 'nupdate':
      // process a network update action
      $OBJ_linkedin = new linkedin_API();
      $OBJ_linkedin->set_token_access($_SESSION['oauth']['linkedin']['access']);
      $response = $OBJ_linkedin->update_network($_POST['nupdate']);
      if($response['success'] === TRUE) {
        // status has been updated
        header('Location: ' . $_SERVER['PHP_SELF']);
      } else {
        // an error occured
        echo "Error posting network update:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
      }
      break;
    case 'reshare':
      // process a status update action
      $OBJ_linkedin = new linkedin_API();
      $OBJ_linkedin->set_token_access($_SESSION['oauth']['linkedin']['access']);
      
      // prepare content for sharing
      $content = array();
      if(!empty($_POST['scomment'])) {
        $content['comment'] = $_POST['scomment'];
      }
      if(!empty($_POST['sid'])) {
        $content['id'] = $_POST['sid'];
      }
      if(!empty($_POST['sprivate'])) {
        $private = TRUE;
      } else {
        $private = FALSE;
      }
      
      // re-share content
      $response = $OBJ_linkedin->share('reshare', $content, $private);
      if($response['success'] === TRUE) {
        // status has been updated
        header('Location: ' . $_SERVER['PHP_SELF']);
      } else {
        // an error occured
        echo "Error re-sharing content:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
      }
      break;
    case 'revoke':
      $OBJ_linkedin = new linkedin_API();
      $OBJ_linkedin->set_token_access($_SESSION['oauth']['linkedin']['access']);
      $response = $OBJ_linkedin->revoke();
      if($response['success'] === TRUE) {
        // revocation successful, clear session
        session_unset();
        $_SESSION = array();
        if(session_destroy()) {
          // session destroyed
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // session not destroyed
          echo "Error clearing user's session";
        }
      } else {
        // revocation failed
        echo "Error revoking user's token:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
      }
      break;
    case 'share':
      // process a status update action
      $OBJ_linkedin = new linkedin_API();
      $OBJ_linkedin->set_token_access($_SESSION['oauth']['linkedin']['access']);
      
      // prepare content for sharing
      $content = array();
      if(!empty($_POST['scomment'])) {
        $content['comment'] = $_POST['scomment'];
      }
      if(!empty($_POST['stitle'])) {
        $content['title'] = $_POST['stitle'];
      }
      if(!empty($_POST['surl'])) {
        $content['submitted-url'] = $_POST['surl'];
      }
      if(!empty($_POST['simgurl'])) {
        $content['submitted-image-url'] = $_POST['simgurl'];
      }
      if(!empty($_POST['sdescription'])) {
        $content['description'] = $_POST['sdescription'];
      }
      if(!empty($_POST['sprivate'])) {
        $private = TRUE;
      } else {
        $private = FALSE;
      }
      
      // share content
      $response = $OBJ_linkedin->share('new', $content, $private);
      if($response['success'] === TRUE) {
        // status has been updated
        header('Location: ' . $_SERVER['PHP_SELF']);
      } else {
        // an error occured
        echo "Error sharing content:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
      }
      break;
    case 'unlike':
      $OBJ_linkedin = new linkedin_API();
      $OBJ_linkedin->set_token_access($_SESSION['oauth']['linkedin']['access']);
      if(!empty($_GET['nKey'])) {
        $response = $OBJ_linkedin->unlike($_GET['nKey']);
        if($response['success'] === TRUE) {
          // update 'unliked'
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // problem with 'unlike'
          echo "Error 'unliking' update:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r($OBJ_linkedin, TRUE);
        }
      } else {
        echo "You must supply a network update key to 'unlike' an update.";
      }
      break;
    default:
      // nothing being passed back, display demo page
      if(extension_loaded('curl')) {
        $curl_version = curl_version();
        $curl_version = $curl_version['version'];
      } else {
        echo "You must load the cURL extension to use this library.";
        exit();
      }
      ?>
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
        <head>
          <title>Simple-LinkedIn Demo Page</title>
          <meta name="author" content="Paul Mennega <paul@fiftymission.net>" />
          <meta name="copyright" content="Copyright 2010, fiftyMission Inc." />
          <meta name="license" content="http://www.opensource.org/licenses/mit-license.php" />
          <meta name="description" content="A demonstration page for the Simple-LinkedIn PHP class." />
          <meta name="keywords" content="simple-linkedin,php,linkedin,api,class,library" />
          <meta name="medium" content="mult" />
          <meta name="viewport" content="width=device-width" />
          <meta http-equiv="Content-Language" content="en" />
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        </head>
        <body>
          <h1><a href="<?php echo $_SERVER['PHP_SELF'];?>">Simple-LinkedIn Demo Page</a></h1>
          
          <p>Copyright 2010, Paul Mennega, fiftyMission Inc. &lt;paul@fiftymission.net&gt;</p>
          
          <p>Released under the MIT License - http://www.opensource.org/licenses/mit-license.php</p>
          
          <p>Full source code for both the Simple-LinkedIn class and this demo script can be found at: <a href="http://code.google.com/p/simple-linkedinphp/">http://code.google.com/p/simple-linkedinphp/</a></p>
          
          <hr />
          
          <p style="font-weight: bold;">Using; Simple-LinkedIn Version - <?php echo linkedin_API::_VERSION;?>, cURL Version - <?php echo $curl_version;?>, PHP Version - <?php echo phpversion();?></p>
          
          <hr />
          
          <?php
          $_SESSION['oauth']['linkedin']['authorized'] = (isset($_SESSION['oauth']['linkedin']['authorized'])) ? $_SESSION['oauth']['linkedin']['authorized'] : FALSE;
          if($_SESSION['oauth']['linkedin']['authorized'] === TRUE) {
            ?>
            <ul>
              <li><a href="#manage">Manage LinkedIn Authorization</a></li>
              <li><a href="#profile">Your Profile</a></li>
              <li><a href="#network">Your Network</a>
                <ul>
                  <li><a href="#network_stats">Stats</a></li>
                  <li><a href="#network_connections">Your Connections</a>
                    <ul>
                      <li><a href="#network_connections_message">Send a Message to the Checked Connections Above</a></li>
                    </ul>
                  </li>
                  <li><a href="#network_invite">Invite Others to Join your LinkedIn Network</a></li>
                  <li><a href="#network_updates">Recent Connection Updates</a></li>
                </ul>
              </li>
              <li><a href="#search">People Search</a></li>
              <li><a href="#content">Creating / Sharing Content</a>
                <ul>
                  <li><a href="#content_update">Post Network Update</a></li>
                  <li><a href="#content_share">Share Content</a></li>
                </ul>
              </li>
            </ul>
            <?php
          } else {
            ?>
            <ul>
              <li><a href="#manage">Manage LinkedIn Authorization</a></li>
            </ul>
            <?php
          }
          ?>
          
          <hr />
          
          <h2 id="manage">Manage LinkedIn Authorization:</h2>
          <?php
          if($_SESSION['oauth']['linkedin']['authorized'] === TRUE) {
            // user is already connected
            $OBJ_linkedin = new linkedin_API();
            if($OBJ_linkedin->set_token_access($_SESSION['oauth']['linkedin']['access'])) {
              ?>
              <form id="linkedin_revoke_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
                <input type="hidden" name="<?php echo linkedin_API::_GET_TYPE;?>" id="<?php echo linkedin_API::_GET_TYPE;?>" value="revoke" />
                <input type="submit" value="Revoke Authorization" />
              </form>
              
              <hr />
              
              <h2 id="profile">Your Profile:</h2>
              
              <?php
              $response = $OBJ_linkedin->profile('~:(id,first-name,last-name,picture-url)');
              if($response['success'] === TRUE) {
                $response['linkedin'] = new SimpleXMLElement($response['linkedin']);
                echo "<pre>" . print_r($response['linkedin'], TRUE) . "</pre>";
              } else {
                // profile retrieval failed
                echo "Error retrieving profile information:\n\nRESPONSE:\n\n<pre>" . print_r($response) . "</pre>";
              } 
              ?>
              
              <hr />
              
              <h2 id="network">Your Network:</h2>
              
              <h3 id="network_stats">Stats:</h3>
              
              <?php
              $response = $OBJ_linkedin->statistics();
              if($response['success'] === TRUE) {
                $response['linkedin'] = new SimpleXMLElement($response['linkedin']);
                echo "<pre>" . print_r($response['linkedin'], TRUE) . "</pre>"; 
              } else {
                // statistics retrieval failed
                echo "Error retrieving network statistics:\n\nRESPONSE:\n\n<pre>" . print_r($response) . "</pre>";
              } 
              ?>
              
              <hr />
              
              <?php
              $response = $OBJ_linkedin->connections();
              if($response['success'] === TRUE) {
                  echo "<pre>".print_r($response,true)."</pre>";
                $connections = new SimpleXMLElement($response['linkedin']);
                ?>
                <h3 id="network_connections">Your Connections: (<?php echo $connections['total'];?>)</h3>
                <form id="linkedin_cmessage_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                  <input type="hidden" name="<?php echo linkedin_API::_GET_TYPE;?>" id="<?php echo linkedin_API::_GET_TYPE;?>" value="message" />
                  <?php
                  foreach($connections->person as $connection) {
                    ?>
                    <div style="float: left; width: 150px; border: 1px solid #888; margin: 0.5em; text-align: center;">
                      <?php
                      if($connection->{'picture-url'}) {
                        ?>
                        <img src="<?php echo $connection->{'picture-url'};?>" alt="" title="" width="80" height="80" style="display: block; margin: 0 auto; padding: 0.25em;" />
                        <?php
                      } else {
                        ?>
                        <img src="./anonymous.png" alt="" title="" width="80" height="80" style="display: block; margin: 0 auto; padding: 0.25em;" />
                        <?php
                      }
                      ?>
                      <input type="checkbox" name="connections[]" id="connection_<?php echo $connection->id;?>" value="<?php echo $connection->id;?>" />
                      <label for="connection_<?php echo $connection->id;?>"><?php echo $connection->{'first-name'};?></label>
                      <div><?php echo $connection->id;?></div>
                    </div>
                    <?php
                  }
                } else {
                  // connections retrieval failed
                  echo "Error retrieving connections:\n\nRESPONSE:\n\n<pre>" . print_r($response) . "</pre>";
                }
                ?>
                
                <br style="clear: both;" />
                
                <h4 id="network_connections_message">Send a Message to the Checked Connections Above:</h4>
                
                <div style="font-weight: bold;">Subject:</div>            
                <input type="text" name="message_subject" id="message_subject" length="255" maxlength="255" style="display: block; width: 400px;" />
                
                <div style="font-weight: bold;">Message:</div>
                <textarea name="message_body" id="message_body" rows="4" style="display: block; width: 400px;"></textarea>
                <input type="submit" value="Send Message" /><input type="checkbox" value="1" name="message_copy" id="message_copy" checked="checked" /><label for="message_copy">copy self on message</label>
                
                <p>(Note, any HTML in the subject or message bodies will be stripped by the LinkedIn->message() method)</p>
              
              </form>
              
              <hr />
  
              <h3 id="network_invite">Invite Others to Join your LinkedIn Network:</h3>
              <form id="linkedin_imessage_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <input type="hidden" name="<?php echo linkedin_API::_GET_TYPE;?>" id="<?php echo linkedin_API::_GET_TYPE;?>" value="invite" />
     
                <div style="font-weight: bold;">By Email Address and Name:</div>            
                <input type="text" name="invite_to_email" id="invite_to_email" length="255" maxlength="255" style="display: block; width: 400px;" value="Email" />
                <input type="text" name="invite_to_firstname" id="invite_to_firstname" length="255" maxlength="255" style="display: block; width: 400px;" value="First Name" />
                <input type="text" name="invite_to_lastname" id="invite_to_lastname" length="255" maxlength="255" style="display: block; width: 400px;" value="Last Name" />
                
                <div style="font-weight: bold;">Or By LinkedIn ID:</div> 
                <input type="text" name="invite_to_id" id="invite_to_id" length="255" maxlength="255" style="display: block; width: 400px;" />
    
                <div style="font-weight: bold;">Subject:</div>            
                <input type="text" name="invite_subject" id="invite_subject" length="255" maxlength="255" style="display: block; width: 400px;" value="<?php echo linkedin_API::_INV_SUBJECT;?>" />
                
                <div style="font-weight: bold;">Message:</div>
                <textarea name="invite_body" id="invite_body" rows="4" style="display: block; width: 400px;"></textarea>
                <input type="submit" value="Send Invitation" />
                
                <p>(Note, any HTML in the subject or message bodies will be stripped by the LinkedIn->invite() method)</p>
    
              </form>
              
              <hr />
              
              <h3 id="network_updates">Recent Connection Updates: (last <?php echo UPDATE_COUNT;?>, shared content only)</h3>
              
              <?php
              $query    = '?type=SHAR&count=' . UPDATE_COUNT;
              $response = $OBJ_linkedin->updates($query);
              if($response['success'] === TRUE) {
                $updates = new SimpleXMLElement($response['linkedin']);
                foreach($updates->update as $update) {
                  //echo "<pre>" . print_r($update, TRUE) . "</pre>";
                  $person = $update->{'update-content'}->person;
                  $share  = $update->{'update-content'}->person->{'current-share'};
                  ?>
                  <div style=""><span style="font-weight: bold;"><a href="<?php echo $person->{'site-standard-profile-request'}->url;?>"><?php echo $person->{'first-name'} . ' ' . $person->{'last-name'} . '</a></span> ' . $share->comment;?></div>
                  <?php
                  if($share->content) {
                    ?>
                    <div style="width: 400px; margin: 0.5em 0 0.5em 2em;"><a href="<?php echo $share->content->{'submitted-url'};?>"><?php echo $share->content->title;?></a></div>
                    <div style="width: 400px; margin: 0.5em 0 0.5em 2em;"><?php echo $share->content->description;?></div>
                    <div style="margin: 0.5em 0 0.5em 2em;"><span style="font-weight: bold;">Share this content with your network:</span>
                      <form id="linkedin_reshare_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <input type="hidden" name="<?php echo linkedin_API::_GET_TYPE;?>" id="<?php echo linkedin_API::_GET_TYPE;?>" value="reshare" />
                        <input type="hidden" id="sid" name="sid" value="<?php echo $share->id;?>" />
                        <textarea name="scomment" id="scomment_<?php echo $share->id;?>" rows="4" style="display: block; width: 400px;"></textarea>
                        <input type="submit" value="Re-Share Content" /><input type="checkbox" value="1" name="sprivate" id="sprivate_<?php echo $share->id;?>" checked="checked" /><label for="rsprivate">re-share with your connections only</label>
                      </form>
                    </div>
                    <?php
                  }
                  ?>
                  <div style="margin: 0.5em 0 0 2em;">
                    <?php
                    if($update->{'is-likable'} == 'true') {
                      if($update->{'is-liked'} == 'true') {
                        echo '<a href="' . $_SERVER['PHP_SELF'] . '?' . linkedin_API::_GET_TYPE . '=unlike&amp;nKey=' . $update->{'update-key'} . '">Unlike</a> (' . $update->{'num-likes'} . ')';
                      } else {
                        echo '<a href="' . $_SERVER['PHP_SELF'] . '?' . linkedin_API::_GET_TYPE . '=like&amp;nKey=' . $update->{'update-key'} . '">Like</a> (' . $update->{'num-likes'} . ')';
                      }
                      if($update->{'num-likes'} > 0) {
                        $likes = $OBJ_linkedin->likes((string)$update->{'update-key'});
                        if($likes['success'] === TRUE) {
                          $likes['linkedin'] = new SimpleXMLElement($likes['linkedin']);
                          echo "<pre>" . print_r($likes['linkedin'], TRUE) . "</pre>";
                        } else {
                          // likes retrieval failed
                          echo "Error retrieving likes:\n\nRESPONSE:\n\n<pre>" . print_r($likes) . "</pre>";
                        }
                      }
                    }
                    ?>
                  </div>
                  <div style="margin: 0.5em 0 0 2em;">
                    <?php
                    if($update->{'is-commentable'} == 'true') {
                      if($update->{'update-comments'}) {
                        // there are comments for this update
                        echo $update->{'update-comments'}['total'] . ' Comment(s)';
                        
                        $comments = $OBJ_linkedin->comments((string)$update->{'update-key'});
                        if($comments['success'] === TRUE) {
                          $comments['linkedin'] = new SimpleXMLElement($comments['linkedin']);
                          echo "<pre>" . print_r($comments['linkedin'], TRUE) . "</pre>";
                        } else {
                          // comments retrieval failed
                          echo "Error retrieving comments:\n\nRESPONSE:\n\n<pre>" . print_r($comments) . "</pre>";
                        }
                      } else {
                        // no comments for this update
                        echo 'No Comments';
                      }
                      ?>
                      <div style="margin: 0 0 0 2em;">
                        <form id="linkedin_comment_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                          <input type="hidden" name="<?php echo linkedin_API::_GET_TYPE;?>" id="<?php echo linkedin_API::_GET_TYPE;?>" value="comment" />
                          <input type="hidden" id="nkey" name="nkey" value="<?php echo $update->{'update-key'};?>" />
                          <textarea name="scomment" id="scomment_<?php echo $share->id;?>" rows="4" style="display: block; width: 400px;"></textarea>
                          <input type="submit" value="Post Comment" />
                        </form>
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                  <div style="border-bottom: 1px dashed #000; margin: 1em 0;"></div>
                  <?php
                }
              } else {
                // update retrieval failed
                echo "Error retrieving updates:\n\nRESPONSE:\n\n<pre>" . print_r($response) . "</pre>";                
              }
              ?>
              
              <hr />
              
              <h2 id="search">People Search:</h2>
              
              <p>All 1st degree connections living in the San Francisco Bay Area (returned in JSONP format):</p>
              
              <?php
              $OBJ_linkedin->set_response_format(linkedin_API::_RESPONSE_JSONP);
              $query    = '?facet=location,us:84&facet=network,F';
              $response = $OBJ_linkedin->search($query);
              if($response['success'] === TRUE) {
                //$response['linkedin'] = new SimpleXMLElement($response['linkedin']);
                echo "<pre>" . print_r($response['linkedin'], TRUE) . "</pre>";
              } else {
                // people search retrieval failed
                echo "Error retrieving search results:\n\nRESPONSE:\n\n<pre>" . print_r($response) . "</pre>";                
              }
              ?>
              
              <hr />
              
              <h2 id="content">Creating / Sharing Content</h2>
              
              <h3 id="content_update">Post Network Update:</h3>
              <form id="linkedin_nu_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <input type="hidden" name="<?php echo linkedin_API::_GET_TYPE;?>" id="<?php echo linkedin_API::_GET_TYPE;?>" value="nupdate" />
                <textarea name="nupdate" id="nupdate" rows="4" style="display: block; width: 400px;"></textarea>
                <input type="submit" value="Post Network Update" />
              </form>
              
              <hr />
              
              <h3 id="content_share">Share Content:</h3>
              <form id="linkedin_share_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <input type="hidden" name="<?php echo linkedin_API::_GET_TYPE;?>" id="<?php echo linkedin_API::_GET_TYPE;?>" value="share" />
                <div style="font-weight: bold;">Comment:</div>
                <textarea name="scomment" id="scomment" rows="4" style="display: block; width: 400px;"></textarea>
                
                <div style="font-weight: bold;">Title:</div>            
                <input type="text" name="stitle" id="stitle" length="255" maxlength="255" style="display: block; width: 400px;" value="" />
                
                <div style="font-weight: bold;">Content Url:</div>            
                <input type="text" name="surl" id="surl" length="255" maxlength="255" style="display: block; width: 400px;" value="" />
                
                <div style="font-weight: bold;">Content Picture Url:</div>            
                <input type="text" name="simgurl" id="simgurl" length="255" maxlength="255" style="display: block; width: 400px;" value="" />
                
                <div style="font-weight: bold;">Description:</div>
                <textarea name="sdescription" id="sdescription" rows="4" style="display: block; width: 400px;"></textarea>
                
                <input type="submit" value="Post Content" /><input type="checkbox" value="1" name="sprivate" id="sprivate" checked="checked" /><label for="sprivate">share with your connections only</label>
              </form>
              <?php
            } else {
              // failed setting user access token
              echo "An error occured setting the user access token.";
            }
          } else {
            // user isn't connected
            ?>
            <form id="linkedin_connect_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
              <input type="hidden" name="<?php echo linkedin_API::_GET_TYPE;?>" id="<?php echo linkedin_API::_GET_TYPE;?>" value="initiate" />
              <input type="submit" value="Connect to LinkedIn" />
            </form>
            <?php
          }
          ?>
        </body>
      </html>
      <?php
      break;
  }
} catch(LinkedInException $e) {
  // exception raised by library call
  echo $e->getMessage();
}

?>