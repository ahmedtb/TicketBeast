<?php

namespace Tests\Feature;

use App\Models\Concert;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_ticket_can_be_released()
    {
        $concert = Concert::factory()->create();
        $concert->addTickets(1);
        $order = $concert->orderTickets('jane@example.com',1);
        $ticket = $order->tickets()->first();
        $this->assertEquals($order->id, $ticket->order_id);
        $ticket->release();
        $this->assertNull($ticket->freash()->order_id);
    }
}
