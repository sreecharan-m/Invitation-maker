<?php

if(isset($_POST['submit']))

{
require __DIR__ . '/vendor/autoload.php';
/*
if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}*/

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    //$client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
    $client->setScopes(CalendarScopes.CALENDAR);
    $client->setAuthConfig(__DIR__ . '/credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');
    $client->setRedirectUri("urn:ietf:wg:oauth:2.0:oob");
    //$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
  'maxResults' => 10,
  'orderBy' => 'startTime',
  'singleEvents' => true,
  'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);
$events = $results->getItems();








// Refer to the Java quickstart on how to setup the environment:
// https://developers.google.com/calendar/quickstart/java
// Change the scope to CalendarScopes.CALENDAR and delete any stored
// credentials.

Event event = new Event()
    .setSummary("Google I/O 2015")
    .setLocation("800 Howard St., San Francisco, CA 94103")
    .setDescription("A chance to hear more about Google's developer products.");

DateTime startDateTime = new DateTime("2015-05-28T09:00:00-07:00");
EventDateTime start = new EventDateTime()
    .setDateTime(startDateTime)
    .setTimeZone("America/Los_Angeles");
event.setStart(start);

DateTime endDateTime = new DateTime("2015-05-28T17:00:00-07:00");
EventDateTime end = new EventDateTime()
    .setDateTime(endDateTime)
    .setTimeZone("America/Los_Angeles");
event.setEnd(end);

String[] recurrence = new String[] {"RRULE:FREQ=DAILY;COUNT=2"};
event.setRecurrence(Arrays.asList(recurrence));

EventAttendee[] attendees = new EventAttendee[] {
    new EventAttendee().setEmail("lpage@example.com"),
    new EventAttendee().setEmail("sbrin@example.com"),
};
event.setAttendees(Arrays.asList(attendees));

EventReminder[] reminderOverrides = new EventReminder[] {
    new EventReminder().setMethod("email").setMinutes(24 * 60),
    new EventReminder().setMethod("popup").setMinutes(10),
};
Event.Reminders reminders = new Event.Reminders()
    .setUseDefault(false)
    .setOverrides(Arrays.asList(reminderOverrides));
event.setReminders(reminders);

String calendarId = "primary";
event = service.events().insert(calendarId, event).execute();
System.out.printf("Event created: %s\n", event.getHtmlLink());









if (empty($events)) {
    print "No upcoming events found.\n";
} else {
    print "Upcoming events:\n";
    foreach ($events as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        printf("%s (%s)\n", $event->getSummary(), $start);
    }
}


}
?>



<!DOCTYPE html>


<html>


<head>
    <title>INVITATION MAKER</title>

    <style type="text/css">

    body {

        margin:14vh;
        display: flex;
        justify-content: center;
    }       

    #fullcontent {
        display: flex;
        justify-content: center;
        flex-direction: column;
        background: rgb(0,0,0,0.15);
        box-shadow: 5px 5px 10px rgb(255,165,0,1);
    }

    #welcome {
        
        font-size: 24px;
        margin: 10vh;

    }
    #submitbutton {
        text-align: center;
        margin-top: 5vh;
        margin-bottom: 5vh; 
    }

    #sub {
        border: 1px solid #ffa500;
        background-color: #000;
        color: #ffa500;
        font-size: 18px;
        padding: 7px;
        border-radius: 5px;
    }

    </style>

</head>


<body>

<div id="fullcontent" >
    <div id="welcome" style="font-weight: 900;">
        Please fill the following to integrate this event to google calender.
    </div>

    <div id="preferences" style="display: flex; justify-content: center;">
        
        <form action="quickstart.php" method="POST">
        <table>
        <tr class="rows">
                <td class="tdl" style="font-size: 25px; display: flex; align-items: center; margin: 10px; padding: 5px; background-color: #000; border-radius: 5px; justify-content: center; color: #ffa500;"><i>DATE :</i>
                </td>
                <td class="tdl">
                <div style="display: flex; flex-direction: row; align-items: center;">
                        <input type="date" id="nos" name="date" style="border-radius: 5px; border:2.5px solid #ffa500; font-size: 20px; text-align: center; ">
                </td>
        </tr>

        <tr class="rows">
                <td class="tdl" style="font-size: 25px; display: flex; align-items: center; margin: 10px; padding: 5px; background-color: #000; border-radius: 5px; justify-content: center; color: #ffa500;"><i>TIME :</i>
                </td>
                <td class="tdl">
                <div style="display: flex; flex-direction: row; align-items: center;">
                        <input type="time" id="food" name="time" style="border-radius: 5px; border:2.5px solid #ffa500; font-size: 20px; text-align: center;">
                </td>
        </tr>
        </table>
        <div id="submitbutton">
        <button id="sub" name="submit">SUBMIT</button>
        </div>
        </form>
    </div>
    
</div>

</body>
</html>