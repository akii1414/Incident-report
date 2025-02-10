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
                width:60%;
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
            .section{
                font-weight: bold;
                margin-top: 20px;
            }
            hr {
                border: 1px solid;
            }
            th{
                border: 1px solid;
                text-align: left;
                background-color: rgb(182, 179, 179);
            }
            footer {
                font-size: 15px;
                font-style: italic;
                padding: 3px;
                color: gray;
            }
            .table-info{
                border-collapse: collapse;
                border: 1px solid black;
                width: 100%;
                break-inside: avoid;
                page-break-inside: avoid;

            }
            .table-info td {
            padding: 1px 5px; 
            break-inside: avoid;
            page-break-inside: avoid;
            }
            .table-description{
                border-collapse: collapse;
                border: 1px solid black;
                width: 100%;
                break-inside: avoid;
                page-break-inside: avoid;
            }
            .table-impact{
                border-collapse: collapse;
                border: 1px solid black;
                width: 100%;
                break-inside: avoid;
                page-break-inside: avoid;
            }
            .table-notified{
                border-collapse: collapse;
                border: 1px solid black;
                width: 100%;
                break-inside: avoid;
                page-break-inside: avoid;
            }
            .table-steps{
                border-collapse: collapse;
                border: 1px solid black;
                width: 100%;
                break-inside: avoid;
                page-break-inside: avoid;
            }
            .table-details {
                border-collapse: collapse;
                border: 1px solid black;
                width: 100%;
                break-inside: avoid;
                page-break-inside: avoid;
            }
            .table-details th, 
            .table-details td {
                border: 1px solid black;
                border-collapse: collapse;
                break-inside: avoid;
                page-break-inside: avoid;
            }
            .text-red{
                color: red
            }
        </style>
    </head>
    <body>
        <div class="flex-container">
            <table>
                <tr>
                    <td class="column1">
                        <img src="{{ public_path('/images/pagasa-logo.png') }}" alt="PAGASA LOGO" class="logo">
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
                        <img src="{{ public_path('/images/Hi-Res-BAGONG-PILIPINAS-LOGO.png') }}" alt="BAGONG PILIPINAS LOGO" class="logo">
                    </td>
                </tr>
            </table>
            <hr>
        </div>

        <div class="container">
            <h2>Incident Report</h2>
            <table  class="table-info">
                <tr>
                  <th colspan="3">I. Contact Information for this Incident</th>
                </tr>
                <tr>
                  <td>Full name</td>
                  <td colspan="2">{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td colspan="2">{{ Auth::user()->email }}</td>
                </tr>
            </table>
              <br>

            <table class="table-description">
                <tr>
                  <th colspan="3">II. Incident Description</th>
                </tr>
                <tr>
                  <td colspan="3">Please provide a brief description (includes screenshot/image available)</td>
                </tr>
                <tr>
                    @php
                        $images = json_decode($data->images, true);
                    @endphp
                  
                    @if(!empty($images) && is_array($images))
                        @foreach($images as $image)
                            <tr>
                                <td colspan="3">
                                    <p class="text-red" >{{ $image['image_descriptions'] }}</p>
                                    <img src="{{ storage_path('app').'/' . $image['path'] }}" 
                                        alt="Incident Image" style="max-width: 100%; height: auto;">
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tr>
            </table>
            <br>

            <table class="table-impact">
                <tr>
                  <th colspan="3">III. Impact/ potential Impact </th>
                </tr>
                <tr>
                    <td colspan="3">
                        @php
                            $impactList = is_string($data['impact']) ? json_decode($data['impact'], true) : $data['impact'];
                            $impactList = is_array($impactList) ? $impactList : []; 
                        @endphp
                    
                        <ul>
                            @foreach ($impactList as $impact)
                                <li>{{ $impact }}</li>
                            @endforeach
                    
                            @if (empty($impactList))
                                <li>No impact recorded</li>
                            @endif
                        </ul>
                    </td>
                </tr>
              </table>
              <br>
              <table class="table-notified">
                <tr>
                  <th colspan="3">IV. Who else have been notified? </th>
                </tr>
                  <tr>
                  <td colspan="3">Please provide name of person/s:</td>
                </tr>
                <tr>
                  <td class="text-red"  colspan="3">{{ $data['description'] }}</td>
                </tr>
              </table>
              <br>
              <table class="table-steps">
                <tr>
                    <th colspan="3">V. What Steps Have Been Taken So Far? (Check all of the following that apply to this incident)</th>
                </tr>
                <tr>
                    <td colspan="3">
                        @php
                            $steps = is_string($data['steps']) ? json_decode($data['steps'], true) : $data['steps'];
                            $steps = is_array($steps) ? $steps : [];
                        @endphp
                        <ul>
                            @foreach ($steps as $step)
                                @if (str_contains($step, 'Others - Please Describe Below'))
                                    <li><strong>{{ $step }}</strong></li>
                                @else
                                    <li>{{ $step }}</li>
                                @endif
                            @endforeach
            
                            @if (empty($steps))
                                <li>No steps recorded</li>
                            @endif
                        </ul>
                    </td>
                </tr>
                    @if (!empty($data['other_steps_description']))
                    <tr style="border: 1px solid black;">
                        <td colspan="3" style="border: 1px solid black;">
                            <p class="text-red">{{ $data['other_steps_description'] }}</p>
                        </td>
                    </tr>
                    @endif
            </table>
            <br>
            <table class="table-details">
                <tr >
                  <th colspan="3">VI. Incident Details </th>
                </tr>
                <tr>
                   <td>Date  Time the incident was discovered:</td>
                   <td class="text-red"  colspan="2">{{ $data['incident_discovery_time'] }}</td>
                </tr>
                <tr>
                  <td >Has the incident been resolved:</td>
                  <td  class="text-red" colspan="2">{{ $data['incident_resolved'] }}</td>
                </tr>
                <tr>
                  <td >Physical location of affected system(s): </td>
                  <td class="text-red" colspan="2">{{ $data['location'] }}</td>
                </tr>
                <tr>
                  <td >Number of sites affected by the incident: </td>
                  <td class="text-red" colspan="2">{{ $data['sites_affected'] }}</td>
                </tr>
                <tr>
                  <td >Approximate number of systems affected by the incident: </td>
                  <td class="text-red" colspan="2">{{ $data['systems_affected'] }}</td>
                </tr>
                <tr>
                  <td >Approximate number of users affected by the incident:  </td>
                  <td class="text-red" colspan="2" >{{ $data['users_affected'] }}</td>
                </tr>
                <tr>
                  <td >Please provide any additional information that you feel is important but has not been provided elsewhere on this form. </td>
                  <td class="text-red" colspan="2">{{ $data['additional_info'] }}</td>
                </tr>
            </table>
        </div>
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
