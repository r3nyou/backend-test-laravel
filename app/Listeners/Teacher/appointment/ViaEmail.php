<?php

namespace App\Listeners\Teacher\Appointment;

use App\Events\Teacher\Appointment\Book as BookEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\App;

class ViaEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookEvent  $event
     * @return void
     */
    public function handle(BookEvent $event)
    {
        $appointment = $event->appointment;
        App::setLocale($appointment->user->locale);

        echo __('teacher/appointment/book.email', [
            'name' => $appointment->teacher->name,
            'student_name' => $appointment->user->name,
            'start_at' => $appointment->start_at,
        ]);
    }
}
