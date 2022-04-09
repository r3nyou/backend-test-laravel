<?php

namespace App\Listeners;

use App\Events\Teacher\Appointment\Book;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\App;

class BookAppointmentEmail
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
     * @param  object  $event
     * @return void
     */
    public function handle(Book $event)
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
