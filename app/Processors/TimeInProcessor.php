<?php

namespace App\Processors;

use App\Contracts\AttendanceProcessor;

class TimeInProcessor implements AttendanceProcessor
{
    public function process($attendance, $request)
    {
        $attendance->time_in = now()->format('H:i:s');
        $attendance->timein_photo = $request->has('timein_photo') ? $request->timein_photo : null;
        $attendance->remarks = $request->remarks ?? null;
        $attendance->save();

        return $attendance;
    }
}
