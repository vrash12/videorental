
<?php




function sendEmail($to, $subject, $message) {
    $apiKey = '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'; // Replace with your SendGrid API key
    $url = 'https://api.sendgrid.com/v3/mail/send';

    $headers = [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    ];

    $postData = [
        'personalizations' => [
            [
                'to' => [
                    ['email' => $to]
                ],
                'subject' => $subject
            ]
        ],
        'from' => [
            'email' => 'HONEYROSE.SULIVA@live.amaedu.ph', 
            'name' => 'TSU'
        ],
        'content' => [
            [
                'type' => 'text/plain',
                'value' => $message
            ]
        ]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    return $response;
}
?>
