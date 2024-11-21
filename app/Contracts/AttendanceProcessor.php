<?php

namespace App\Contracts;

interface AttendanceProcessor
{
    public function process($attendance, $request);
}
    