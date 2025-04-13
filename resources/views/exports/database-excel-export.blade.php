<table>
    <thead>
    <tr>
        <th colspan="6" style="text-align:center; font-size: 15px; font-weight: 600; height:50px; vertical-align: center; border: 1px solid black;">
            Job Portal
        </th>
    </tr>
    <tr>
        <th style="width: 50px; text-align: center; font-weight: 500; height:30px; vertical-align: center; border: 1px solid black;font-size: 8px;">No</th>
        <th style="width: 100px; text-align: center; font-weight: 500; height:30px; vertical-align: center; border: 1px solid black;font-size: 8px;">Candidate Name</th>
        <th style="width: 80px; text-align: center; font-weight: 500; height:30px; vertical-align: center; border: 1px solid black;font-size: 8px;">Education</th>
        <th style="width: 70px; text-align: center; font-weight: 500; height:30px; vertical-align: center; border: 1px solid black;font-size: 8px;">Experience</th>
        <th style="width: 90px; text-align: center; font-weight: 500; height:30px; vertical-align: center; border: 1px solid black;font-size: 8px;">Contacts</th>
        <th style="width: 100px; text-align: center; font-weight: 500; height:30px; vertical-align: center; border: 1px solid black;font-size: 8px;">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($database as $key => $data)
        <tr>
            <td style="text-align: center; height:20px; vertical-align: center; border: 0.5px solid black;font-size: 8px;">{{ ($key+1) }}</td>
            <td style="text-align: center; height:20px; vertical-align: center; border: 0.5px solid black;font-size: 8px;">{{ isset($data->first_name) ? getTitle($data->title) . ' ' . strip_tags(ucfirst($data->first_name)) . ' ' .strip_tags(ucfirst($data->last_name)) : '--' }}</td>
            <td style="text-align: center; height:20px; vertical-align: center; border: 0.5px solid black;font-size: 8px;">{{ isset($data->education) ? $data->education : '--' }}</td>
            <td style="text-align: center; height:20px; vertical-align: center; border: 0.5px solid black;font-size: 8px;">{{ isset($data->experience) ? explode("-", $data->experience)[0].' Years '. explode("-", $data->experience)[1].' Months' : '--' }}</td>
            <td style="text-align: center; height:20px; vertical-align: center; border: 0.5px solid black;font-size: 8px;">{{ isset($data->email) ? $data->email : '--' }}<br>{{ isset($data->phone) ? $data->phone : '--' }}</td>
            <td style="text-align: center; height:20px; vertical-align: center; border: 0.5px solid black;font-size: 8px;">{!! getActiveInactiveStatusBadge($data->status) !!}</td>
        </tr>
    @endforeach
        <tr>
            <td colspan="6" style="text-align: center; font-size: 10px; font-weight: 600; height:30px; vertical-align: center; border: 1px solid black;">Date: {{ date('Y-m-d H:i:s') }}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center; font-size: 10px; font-weight: 600; height:30px; vertical-align: center; border: 1px solid black;">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</td>
        </tr>
    </tbody>
</table>