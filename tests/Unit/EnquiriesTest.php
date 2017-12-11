<?php

namespace Tests\Unit;

use App\Enquiry;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnquiriesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_can_see_a_list_of_enquiries()
    {
        $user = factory(User::class)->create();
        $enquiry = factory(Enquiry::class)->create();

        $this->be($user);
        $request = $this->get('/enquiries');

        $request->assertSee('johndoe@example.com');
        $request->assertSee('07355352536');
        $request->assertSee('Facebook');
        $request->assertSee('FI8 6TR');
        $request->assertSee('£372.88');
        $request->assertSee('Valuation');
        $request->assertSee('£200,000 - £299,999');
        $request->assertSee('Post 1945');
    }
    
    /** @test */
    function a_user_can_see_a_chart_for_an_enquiry()
    {
        $user = factory(User::class)->create();
        $enquiry = factory(Enquiry::class)->create();

        $this->be($user);
        $request = $this->get('/enquiries/analytics');

//        $request->assertSee($enquiry->)
    }
}
