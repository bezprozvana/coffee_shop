<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrderController
 */
final class OrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $orders = Order::factory()->count(3)->create();

        $response = $this->get(route('orders.index'));

        $response->assertOk();
        $response->assertViewIs('order.index');
        $response->assertViewHas('orders');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('orders.create'));

        $response->assertOk();
        $response->assertViewIs('order.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'store',
            \App\Http\Requests\OrderStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create();
        $total_amount = fake()->randomFloat(/** decimal_attributes **/);
        $order_status = OrderStatus::factory()->create();

        $response = $this->post(route('orders.store'), [
            'user_id' => $user->id,
            'total_amount' => $total_amount,
            'order_status_id' => $order_status->id,
        ]);

        $orders = Order::query()
            ->where('user_id', $user->id)
            ->where('total_amount', $total_amount)
            ->where('order_status_id', $order_status->id)
            ->get();
        $this->assertCount(1, $orders);
        $order = $orders->first();

        $response->assertRedirect(route('orders.index'));
        $response->assertSessionHas('order.id', $order->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.show', $order));

        $response->assertOk();
        $response->assertViewIs('order.show');
        $response->assertViewHas('order');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.edit', $order));

        $response->assertOk();
        $response->assertViewIs('order.edit');
        $response->assertViewHas('order');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'update',
            \App\Http\Requests\OrderUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $order = Order::factory()->create();
        $user = User::factory()->create();
        $total_amount = fake()->randomFloat(/** decimal_attributes **/);
        $order_status = OrderStatus::factory()->create();

        $response = $this->put(route('orders.update', $order), [
            'user_id' => $user->id,
            'total_amount' => $total_amount,
            'order_status_id' => $order_status->id,
        ]);

        $order->refresh();

        $response->assertRedirect(route('orders.index'));
        $response->assertSessionHas('order.id', $order->id);

        $this->assertEquals($user->id, $order->user_id);
        $this->assertEquals($total_amount, $order->total_amount);
        $this->assertEquals($order_status->id, $order->order_status_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $order = Order::factory()->create();

        $response = $this->delete(route('orders.destroy', $order));

        $response->assertRedirect(route('orders.index'));

        $this->assertModelMissing($order);
    }
}
