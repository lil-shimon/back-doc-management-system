<?php

namespace Tests\Feature\Api;

use App\Http\Models\Orders;
use App\Http\Controllers\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class OrderListTest extends TestCase
{

    // reset test data
    use RefreshDatabase;

    // invalidate middleware
    use WithoutMiddleware;

    public function setUp(): void
    {
      parent::setUp();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
   public function testIndex()
    {
      //factory(Orders::class)->create([
      //  'start_date' => 'Oct 2',
      //]);
        // create test data in factory
        //$order1 = factory(Orders::class)->create();
        //$order2 = factory(Orders::class)->create();
        
      // $this->withoutExceptionHandling();
      // Get request
      $response = $this->get(route('orders.index'));

      // test response
      $response->assertOk() #status 200
        ->assertJsonCount(1) #the quantity of array is 1
        ->assertJsonFragment([
          'start_date' => 'Oct 2'
        ]);


    //  response = $this->json('GET', '/api/orders');
    //  response
    //     ->assertStatus(200)
    //     ->assertJson(
    //         [
    //             [
    //                 'id' => $order1->id,
    //                 'start_date' => $order1->start_date,
    //                 'end_date' => $order1->end_date,
    //                 'expected_start_date' => $order1->expected_start_date,
    //                 'expected_end_date' => $order1->expected_end_date,
    //                 'invoice_note' => $order1->invoice_note,
    //                 'sale_note' => $order1->sale_note,
    //                 'maintainance_note' => $order1->maintainance_note,
    //                 'sim_number' => $order1->sim_number,
    //                 'signnage_id' => $order1->signnage_id,
    //                 'order_item_id' => $order1->order_item_id
    //             ],
    //             [
    //                 'id' => $order2->id,
    //                 'start_date' => $order2->start_date,
    //                 'end_date' => $order2->end_date,
    //                 'expected_start_date' => $order2->expected_start_date,
    //                 'expected_end_date' => $order2->expected_end_date,
    //                 'invoice_note' => $order2->invoice_note,
    //                 'sale_note' => $order2->sale_note,
    //                 'maintainance_note' => $order2->maintainance_note,
    //                 'sim_number' => $order2->sim_number,
    //                 'signnage_id' => $order2->signnage_id,
    //                 'user_id' => $order2->user_id
    //             ]
    //         ]
    //      );
    }

    // public function testStore()
    // {
    //     // data for post
    //     $order = [
    //         'order' => [
    //             'start_date' => 'Jan 26',
    //             'end_date' => 'Mar 26',
    //             'expected_start_date' => 'Jan 26',
    //             'expected_end_date' => 'Mar 26',
    //             'invoice_note' => 'something',
    //             'sale_note' => 'contact to admin',
    //             'maintainance_note' => '---',
    //             'sim_number' => '123-123-123',
    //             'signnage_id' => '456-546-456',
    //             'user_id' => '1'
    //         ],
    //     ];

    //     // post request
    //     $response = $this->post(route('orders.store'), $order);

    //     $response->dump();
    //     // test response
    //     $response->assertOk() # status code = 200
    //         # response should include those data
    //         ->assertJsonFragment([ 
    //             'start_date' => 'Jan 26',
    //             'end_date' => 'Mar 26',
    //             'expected_start_date' => 'Jan 26',
    //             'expected_end_date' => 'Mar 26',
    //             'invoice_note' => 'something',
    //             'sale_note' => 'contact to admin',
    //             'maintainance_note' => '---',
    //             'sim_number' => '123-123-123',
    //             'signnage_id' => '456-546-456',
    //             'user_id' => '1'
    //         ]);
    // }
}
