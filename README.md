## Laravel Task

Create a new order feature with menu items.
Make POST api to create new order create a database
schema via migrations and models. menu items should
have item name , item price.

Orders have 3 different types (dine-in, delivery and
takeaway).
Based on the user choice of order type will show the
below:
In delivery type case will add delivery fees and
customer phone number and customer name.
In dine in type will add table number and service charge
and waiter name.

---
### Create Order API

`POST /api/orders`

```json
{
    "type": "dine_in",
    "items": [
        {
            "id": 1,
            "quantity": 2
        },
        {
            "id": 2,
            "quantity": 15
        },
        {
            "id": 3,
            "quantity": 15
        }
    ],
    "customer_phone": "4524421",
    "customer_name": "Customer One",
    "delivery_fees": "20.0",
    "table_number": 3,
    "service_charge": 25,
    "waiter_name": "Waiter One"
}
```
---
### Count all except 5 API

`GET /api/count-all-except-five?start=1&end=10`


```json
{
    "start": 249,
    "end": 479632
}
```
---

### Alpha to Int

`GET /api/alpha-to-int?string=BFG`

| Parameter | Type     | Description                |
|:----------|:---------|:---------------------------|
| `string`  | `string` | **Required**. Alpha String |

---

### Min Steps

`GET /api/min-steps?n=2&q[0]=1&q[1]=2`

| Parameter | Type    | Description                   |
|:----------|:--------|:------------------------------|
| `Q`       | `int`   | **Required**. Array Size      |
| `N`       | `array` | **Required**. Array of size n |

---

### Unit Test

Run unit tests using `php artisan test`
