<?php

namespace App\Processors;

use App\Contracts\AttendanceProcessor;

class TimeOutProcessor implements AttendanceProcessor
{
    public function process($attendance, $request)
    {
        $attendance->time_out = now()->format('H:i:s');
        $attendance->timeout_photo = $request->has('timeout_photo') ? $request->timeout_photo : null;
        $attendance->remarks = $request->remarks ?? null;
        $attendance->save();

        return $attendance;
    }
}
