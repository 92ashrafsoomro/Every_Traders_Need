<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', sans-serif; margin: 0; padding: 0; background-color: #0E1B2B; color: #B1BFCD; }
        .container { width: 100%; max-width: 600px; margin: 20px auto; background-color: #000E20; border: 1px solid #343E4B; border-radius: 12px; overflow: hidden; }
        .header { background-color: #0080FF; padding: 25px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; letter-spacing: 1px; }
        .content { padding: 30px; }
        .field-group { margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #343E4B; }
        .label { color: #0080FF; font-size: 12px; text-transform: uppercase; font-weight: bold; margin-bottom: 5px; display: block; }
        .value { color: #ffffff; font-size: 16px; margin: 0; }
        .description-box { background-color: #021830; padding: 15px; border-radius: 8px; border-left: 4px solid #0080FF; color: #B2C0C3; margin-top: 10px; }
        .footer { padding: 20px; text-align: center; font-size: 12px; color: #353f4c; background-color: #000E20; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Help & Support</h1>
        </div>

        <div class="content">

            <div class="field-group">
                <span class="label">From</span>
                <p class="value"><strong>{{ $data['name'] }}</strong> ({{ $data['email'] }})</p>
            </div>

            <div class="field-group">
                <span class="label">Subject</span>
                <p class="value">{{ $data['subject'] }}</p>
            </div>

            <div>
                <span class="label">Description / Message</span>
                <div class="description-box">
                    {!! $data['description'] !!}
                </div>
            </div>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} AutoBoli. All rights reserved. <br>
            This is an automated notification.
        </div>
    </div>
</body>
</html>