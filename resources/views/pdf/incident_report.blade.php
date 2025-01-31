<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Report</title>
    <style>
        body {
            font-family: helvetica;
            line-height: 1.5;
            color: #333;
        }
        .flex-container{
            display: flex;
            margin: 0 auto;
            justify-content: space-around;
            align-items: center;
        }
        .logo {
            width: 90px;
            height: 90px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 8px;
            vertical-align: top;
        }
        .column1{
            width: 15%;
            background-color: rgba(0, 0, 0, 0);
        }
        .column2{
            width:70%;
            padding-top: 0;
            background-color: rgba(0, 0, 0, 0);

        }
        .column3{
            width: 20%;
            text-align: right;
            background-color: rgba(0, 0, 0, 0);
        }
        .column4{
            width: 50%;
            background-color: rgba(0, 0, 0, 0);
        }
        .column5{
            width: 50%;
            text-align: right;
            background-color: rgba(0, 0, 0, 0);
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
        }
        hr {
            border: 1px solid;
        }
        footer {
            font-size: 15px;
            font-style: italic;
            padding: 3px;
            color: gray;
        }
    </style>
</head>
<body>
    <div class="flex-container">
        <table>
            <tr>
                <td class="column1">
                    <img src="https://pubfiles.pagasa.dost.gov.ph/pagasaweb/images/pagasa-logo.png" alt="PAGASA LOGO" class="logo">
                </td>
                <td class="column2">
                    <p><b>Republic of the Philippines<br>
                    DEPARTMENT OF SCIENCE AND TECHNOLOGY</b><br>
                    Philippine Atmospheric, Geophysical and Astronomical <br>
                    Services Administration (PAGASA) <br>
                    ETSD - METTS
                    </p>
                </td>
                <td class="column3">
                    <img src="https://upload.wikimedia.org/wikimedia/commons/b/b1/Bagong_Pilipinas_logo.png" alt="BAGONG PILIPINAS LOGO" class="logo">
                </td>
            </tr>
        </table>
        <hr>
    </div>
    
    <h1>Incident Report</h1>
    <p><strong>Reported By:</strong> {{ $data['fullName'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>

    <h2 class="section-title">I. Incident Description</h2>
    <p>{{ $data['incident_description'] }}</p>

    @if(isset($data['imageUpload']) && file_exists(storage_path('app/public/incident_images/' . $data['imageUpload'])))
        <p><strong>Uploaded Image:</strong></p>
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/incident_images/' . $data['imageUpload']))) }}" 
             style="max-width: 100%; height: auto;">
    @else
        <p><strong>Image not found or cannot be loaded.</strong></p>
    @endif

    <h2>Impact / Potential Impact</h2>
    <ul>
        @isset($data['impact'])
            @foreach ($data['impact'] as $impact)
                <li>{{ $impact }}</li>
            @endforeach
        @else
            <li>No impact specified.</li>
        @endisset
    </ul>

    <h2 class="section-title">III. Notified Individuals</h2>
    <p>{{ $data['description'] }}</p>

    <h2 class="section-title">IV. Steps Taken</h2>
    <ul>
        @foreach ($data['steps'] as $step)
            <li>{{ $step }}</li>
        @endforeach
        @if (!empty($data['otherStepsDescription']))
            <li><strong>Other Steps:</strong> {{ $data['otherStepsDescription'] }}</li>
        @endif
    </ul>

    <h2 class="section-title">V. Additional Details</h2>
    <p><strong>Incident Discovery Time:</strong> {{ $data['incident_discovery_time'] }}</p>
    <p><strong>Resolved:</strong> {{ $data['incident_resolved'] }}</p>
    <p><strong>Location:</strong> {{ $data['location'] }}</p>
    <p><strong>Sites Affected:</strong> {{ $data['sites_affected'] }}</p>
    <p><strong>Systems Affected:</strong> {{ $data['systems_affected'] }}</p>
    <p><strong>Users Affected:</strong> {{ $data['users_affected'] }}</p>
    <p><strong>Additional Info:</strong> {{ $data['additional_info'] }}</p>

    <footer>
        <table>
            <tr>
                <?php date_default_timezone_set('Asia/Manila'); ?>
                <td class="column4">
                    <p>"Tracking the sky... Helping the country"</p>
                </td>
                <td class="column5">
                    <p>{{ date('Y-m-d H:i:s') }}</p>
                </td>
            </tr>
        </table>
    </footer>
</body>
</html>
