<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankcardTest extends TestCase
{
    /**
     * Preload session with card data and see it displayed.
     *
     * @return void
     */
    public function testGetWithSessionData()
    {
        $session_data = array(
            'bankcards' => array(
                array(
                    'bank_name' => "Test1 Bank",
                    'bank_card' => '1234-1234-1234-1234',
                    'bank_expiry' => '2009-01-01'
                ),
                array(
                    'bank_name' => "Test2 Bank",
                    'bank_card' => '2341-2341-2341-2341',
                    'bank_expiry' => '2010-01-01'
                )
            )
        );
        $response = $this->withSession($session_data)
            ->get('/bankcards');

        $response->assertStatus(200);
        $response->assertSee('Test2 Bank')
            ->assertSee('Test1 Bank');
    }

    /**
     * Test submit single bank card, redirects to self adding
     * new card data to session and displaying new card data.
     *
     * @return void
     */
     public function testSingleCardSubmit()
     {
         $response = $this->post(
             '/bankcards',
             [
                 'bank_name' => 'TestSingleBank',
                 'bank_card' => '0123-0123-0123-0123',
                 'bank_expiry' => date("Y-m-d")
             ]
        );

        /** sucessfull upload redirects back **/
        $response->assertStatus(302);

        /**
         * now check $this->get has loaded the last submit
         * to session and we can see it displayed albeit the card is obvuscated with 'x'
         */
        $response = $this->get('/bankcards');
        $response->assertSee('TestSingleBank')
            ->assertSee('0123-xxxx-xxxx-xxxx');
     }
}
