<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('97f126e57e6f771a344b', {
      cluster: 'eu',
      encrypted: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(data.message);
    });
  </script>
</head>

<?php
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'eu',
    'encrypted' => true
  );
  $pusher = new Pusher\Pusher(
    '97f126e57e6f771a344b',
    'ba420409bbca5f33db44',
    '446483',
    $options
  );

  $data['message'] = 'hello world';
  $pusher->trigger('my-channel', 'my-event', $data);
?>