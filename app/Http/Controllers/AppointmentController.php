<?php

namespace App\Http\Controllers;

use App\Events\Teacher\Appointment\Book;
use App\Events\Teacher\Appointment\Cancel;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function book()
    {
        // book appointment process...

        Book::dispatch($this->mockAppointment());
    }

    private function mockAppointment(): Appointment
    {
        return Appointment::factory()->make();
    }

    public function cancel(int $id)
    {
        // cancel appointment process...

        Cancel::dispatch(Appointment::first());
    }
}
