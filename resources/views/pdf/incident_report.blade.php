<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Report</title>
        <style>
             @page {
            margin: 90px 50px; 
        }
        header {
            position: fixed;
            top: -90px;
            left: 0;
            right: 0;
            text-align: center;
            height: 100px; 
            z-index: 1000; 
        }
        footer {
            position: fixed;
            bottom: -80px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: gray;
        }

        .footer-page:after {
            content: "Page " counter(page) " of " counter(pages);
        }
            body {
                font-family: Helvetica, Arial, sans-serif;
                color: #333;
                margin: 0;
                padding-top: 75px; 
                padding-bottom: 100px; 

            }
            .flex-container{
                display: flex;
                width: 100%;
                justify-content: space-between;
                align-items: center;
            }
            .container{
                position: relative; 
            }
            .logo {
                width: 100px; 
                height: 100px;
                display: block;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                
            }
            td {
                padding: 5px;
                vertical-align: top;
            }
            .column1{
                width: 15%;
                text-align: center;
                vertical-align: middle;
            }
            .column2{
                width:90%;
                text-align: left;
                font-size: 15px;
                vertical-align: middle;

            }
            .column3{
                width: 15%;
                text-align: center;
                vertical-align: middle;
            }
            .column4{
                width: 50%;
                font-style: italic;
            }
            .column5{
                width: 20%;
            }
            .column6{
                width: 30%;
                text-align: end
            }
            .section{
                font-weight: bold;
                margin-top: 20px;
            }
            h2{
                text-align: center;
                margin-top: -15px;
            }
            .hr-header {
                border: 1px solid;
                margin: -8px;
            }
            .hr-footer {
                border: 1px solid;
                margin-top: 20px; 
                margin-bottom: 5px;      
             }
            th{
                border: 1px solid;
                text-align: left;
                padding: 5px; 

                background-color: rgb(182, 179, 179);
            }
            .table-info{
                border-collapse: collapse;
                border: 1px solid black;
                width: 100%;
                break-inside: avoid;
                page-break-inside: avoid;

            }
            .table-info td {
                border-left: 1px solid black;
                border-right: 1px solid black;
                padding: 0px 5px;
                vertical-align: top;
            }
            .table-info tr:first-child td {
                border-top: 1px solid black;
            }

            .table-info tr:last-child td {
                border-bottom: 1px solid black;
            }

            .table-info a {
                color: blue;
                text-decoration: none;
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
            .column-label {
                width: 60%;
                vertical-align: top;
            }

            .text-red{
                color: red
            }
            .column-hr{
                text-align: right; 
                font-size: 9px;
                margin-right: 20px;
                margin-top: 10px;
            }
            .incident-image {
                width: auto;
                max-width: 500px; 
                height: auto;
                max-height: 300px; }

        </style>
    </head>
    <header>
        <div class="flex-container">
            <table>
                <tr>
                    <td class="column1">
                        <img src="{{ public_path('/images/pagasa-logo.png') }}" alt="PAGASA LOGO" class="logo">
                    </td>
                    <td class="column2">
                        <?php date_default_timezone_set('Asia/Manila'); ?>
                        <p>
                            Republic of the Philippines<br>
                            <b>DEPARTMENT OF SCIENCE AND TECHNOLOGY</b><br>
                            <b>Philippine Atmospheric, Geophysical and Astronomical <br>
                            Services Administration <br>
                            (PAGASA) </b><br>
                        </p>
                    </td>
                    <td class="column3">
                        <img src="{{ public_path('/images/Hi-Res-BAGONG-PILIPINAS-LOGO.png') }}" alt="BAGONG PILIPINAS LOGO" class="logo"><br>
                    </td>
                </tr>
            </div>
            </table>
            <hr class="hr-header">
            <div class="column-hr"> ETSD - METTSS <br>
                {{ date('Y-m-d H:i:s') }}</p</div>
    </header>
    <footer>
        <hr class="hr-footer">
        <table>
            <tr>
                <td class="column4">
                    <p>"Tracking the sky... Helping the country"</p>
                </td>
                <tr>
                    <td class="column5">
                            <p>
                                Science Garden Compound, Senator Miriam P. Defensor-Santiago Avenue,<br>
                                Brgy.Central, Quezon City, Metro Manila, Philippines 1100
                            </p>
                    </td>
                        <td class="column6">
                            <p>Trunkline No.: (+632) 8284-08-00 <br>
                                Website:  http://bagong.pagasa.dost.gov.ph</p>
                            </p>
                        </td>
                    </tr>
            </tr>
        </table>
    </footer>
    <body>
        
        <div class="container">
            <h2 >Incident Report</h2>
            <table  class="table-info">
                <tr>
                  <th colspan="3">I. Contact Information for this Incident</th>
                </tr>
                <tr>
                    <td>Incident ID: </td>
                    <td colspan="2">{{ $data->incident_id }}</td>
                </tr>
                <tr>
                  <td>Name:</td>
                  <td colspan="2">{{ $data->user->full_name }}</td>
                </tr>
                <tr>
                    <td>Position Title:</td>
                    <td colspan="2">{{ $data->user->profile->position }}</td>
                  </tr>
                  <tr>
                    <td>Division/Section:</td>
                    <td colspan="2">{{ $data->user->profile->division }}</td>
                  </tr>
                  <tr>
                    <td>Mobile Phone:</td>
                    <td colspan="2">{{ $data->user->profile->mobile_number }}</td>
                  </tr>
                  <tr>
                    <td>Local Phone:</td>
                    <td colspan="2">{{ $data->user->profile->local_number }}</td>
                  </tr>
                <tr>
                  <td>Email</td>
                  <td colspan="2">{{ $data->user->email }}</td>
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
                                        alt="Incident Image" class="incident-image">
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
                <tr>
                    <th colspan="3">VI. Incident Details</th>
                </tr>
                <tr>
                    <td class="column-label">Date & Time the incident was discovered:</td>
                    <td class="text-red" colspan="2">{{ $data['incident_discovery_time'] }}</td>
                </tr>
                <tr>
                    <td class="column-label">Has the incident been resolved:</td>
                    <td class="text-red" colspan="2">{{ $data['incident_resolved'] }}</td>
                </tr>
            
                @if ($data['incident_resolved'] === "No")
                    <tr>
                        <td class="column-label">Ongoing Time:</td>
                        <td class="text-red" colspan="2">{{ $data['ongoing_time'] }}</td>
                    </tr>
                    <tr>
                        <td class="column-label">Reason for Unresolved Incident:</td>
                        <td class="text-red" colspan="2">
                            @php
                                $incidentReasons = json_decode($data['incident_reason'], true) ?? [];
                            @endphp
                            @if (!empty($incidentReasons))
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach ($incidentReasons as $reason)
                                        @if ($reason !== "Other") 
                                            <li>{{ $reason }}</li>
                                        @endif
                                    @endforeach
                                    @if (!empty($data['other_description_ongoing']))
                                        <li>{{ $data['other_description_ongoing'] }}</li>
                                    @endif
                                </ul>
                            @else
                                <p>No reasons provided.</p>
                            @endif
                        </td>
                    </tr>          
                @endif
                <tr>
                    <td class="column-label">Physical location of affected system(s):</td>
                    <td class="text-red" colspan="2">{{ $data['location'] }}</td>
                </tr>
                <tr>
                    <td class="column-label">Number of sites affected by the incident:</td>
                    <td class="text-red" colspan="2">{{ $data['sites_affected'] }}</td>
                </tr>
                <tr>
                    <td class="column-label">Approximate number of systems affected by the incident:</td>
                    <td class="text-red" colspan="2">{{ $data['systems_affected'] }}</td>
                </tr>
                <tr>
                    <td class="column-label">Approximate number of users affected by the incident:</td>
                    <td class="text-red" colspan="2">{{ $data['users_affected'] }}</td>
                </tr>
                <tr>
                    <td class="column-label">Additional important information:</td>
                    <td class="text-red" colspan="2">{{ $data['additional_info'] }}</td>
                </tr>
            </table>            
        </div>
    </body>
</html>
