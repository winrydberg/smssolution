<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class GenerateInvoiceEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Request $request;
    public string $invoice_category;
    public string $invoice_category_id;

    /**
     * Create a new event instance.
     */
    public function __construct($request , string $invoice_category, $invoice_category_id)
    {
        $this->request = $request;
        $this->invoice_category = $invoice_category;
        $this->invoice_category_id = $invoice_category_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
