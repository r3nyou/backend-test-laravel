<?php

namespace App\Events\Teacher\Appointment;

use App\Events\Event;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Book extends Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Appointment $appointment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function locale(): string
    {
        return $this->appointment->user->locale;
    }

    public function payload(): array
    {
        return [
            'name' => $this->appointment->teacher->name,
            'student_name' => $this->appointment->user->name,
            'start_at' => $this->appointment->start_at,
        ];
    }
}
