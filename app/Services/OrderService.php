<?php

namespace App\Services;

use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderService
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param $order_details
     * @return bool
     */
    public function create($order_details): bool
    {
        //create the order and link it with the customer if it has a customer
        $order = $this->orderRepository->create([
            'type' => $order_details['type'],
            'total_price' => $this->calculateTotalPrice($order_details),
            'customer_id' => $order_details['customer'] == null ? null : $order_details['customer']['id']
        ]);

        //attach order items to the order
        $this->addItemOrder($order, $order_details);

        //save order modifiers (delivery_fees or service_charge) to the database
        $this->createOrderModifiers($order, $order_details);

        return true;
    }

    /**
     * Inserts the given items as well as their quantity and price
     * into the item_order pivot table to persist that an order was created with those items
     *
     * @param $order
     * @param $order_details
     * @return void
     */
    private function addItemOrder($order, $order_details)
    {
        $items = [];
        foreach ($order_details['items'] as $item) {
            $items[$item['id']] = [
                'quantity' => $item['quantity'],
                'item_price' => $item['price']
            ];
        }

        $order->items()->sync($items);
    }

    /**
     * Calculates the order total_price to save it in the database
     *
     * modifier = delivery_fees or service_charge
     * total_cost = (each item price * item quantity) + modifier
     *
     * @param $order_details
     * @return float|int|mixed
     */
    private function calculateTotalPrice($order_details)
    {
        $total_cost = 0;

        // calculate items prices.
        foreach ($order_details['items'] as $item) {
            $total_cost += $item['price'] * $item['quantity'];
        }

        //add modifier to the total cost
        if ($order_details['type'] == 'delivery') {
            $total_cost += $order_details['delivery_fees'];
        } elseif ($order_details['type'] == 'dine_in') {
            $total_cost += $order_details['service_charge'];
        }

        return $total_cost;
    }


    /**
     * Saves that an order X had a modifier Y for example into the database
     * to be able to tell later on that that order had which type of modifier applied
     *
     * @param $order
     * @param $order_details
     * @return void
     */
    private function createOrderModifiers($order, $order_details)
    {
        $data = [];
        $data['order_id'] = $order->id;
        if ($order_details['type'] == 'delivery') {
            $data['type'] = 'delivery_fees';
            $data['price'] = $order_details['delivery_fees'];
        } elseif ($order_details['type'] == 'dine_in') {
            $data['type'] = 'service_fees';
            $data['price'] = $order_details['service_charge'];
        }

        DB::table('order_modifiers')->insert($data);
    }
}
