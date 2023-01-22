<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

class ItemService
{


    /**
     * Get items with provided ids
     *
     * @param $ids
     * @return Item[]|Collection
     */
    private function getItemsIds($ids)
    {
        return Item::whereIn('id', $ids)->get();
    }


    /**
     * arranges the items and then fetches the database models by their ids
     * and then adds the price field to easily calculate item price * quantity given
     *
     * @param $items
     * @return array
     */
    public function getItemsPrice($items): array
    {
        $items = $this->arrangeItems($items);

        $db_items = $this->getItemsIds(array_keys($items));

        if (sizeof($items) != sizeof($db_items)) {
            return [];
        }

        return $this->addPriceToItems($items, $db_items);
    }


    /**
     * Add price key for each item
     *
     * @param $items
     * @param $db_items
     * @return array
     */
    private function addPriceToItems($items, $db_items): array
    {
        foreach ($db_items as $db_item) {
            $items[$db_item->id]['price'] = $db_item->price;
        }

        return $items;
    }

    /**
     * arrange items into item_id => item array for easier manipulation
     *
     * @param $items
     * @return array
     */
    private function arrangeItems($items): array
    {
        $arranged_items = [];
        foreach ($items as $item) {
            $arranged_items[$item['id']] = $item;
        }
        return $arranged_items;
    }


}
