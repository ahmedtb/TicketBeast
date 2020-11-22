<?php

namespace Tests\Feature;

use App\Models\Concert;
use Tests\TestCase;
use App\Models\Order;

class OrderTest extends TestCase
{
    /** @test */
    function tickets_are_released_when_order_are_canceled()
    {
        $concert = Concert::factory()->create();
        $concert->addTickets(10);
        $order = $concert->orderTickets('jane@example.com', 5);
        $this->assertEquals(5, $concert->ticketsRemaining());
        $order->cancel();
        $this->assertEquals(10, $concert->ticketsRemaining());
        $this->assertNull(Order::find($concert->id));
    }
}
