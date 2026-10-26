<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class StorefrontTest extends TestCase
{
    public function test_storefront_pages_render(): void
    {
        $this->get(route('home'))->assertOk()->assertSee('Produk Segar Kami');
        $this->get(route('shop.index'))->assertOk()->assertSee('Brokoli Organik');
        $this->get(route('shop.index', ['q' => 'brokoli']))
            ->assertOk()
            ->assertSee('Brokoli Organik')
            ->assertDontSee('Raspberry');
        $this->get(route('shop.show', 'grapes'))->assertOk()->assertSee('Anggur Segar');
        $this->get(route('cart.index'))->assertOk()->assertSee('Keranjang Anda masih kosong');
        $this->get(route('contact'))->assertOk()->assertSee('Get in touch');
    }

    public function test_products_can_be_added_and_updated_in_the_cart(): void
    {
        $this->withSession(['cart' => []])
            ->post(route('cart.store'), [
                'product_id' => 'grapes',
                'quantity' => 2,
            ])
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas('cart.grapes', 2);

        $this->put(route('cart.update', 'grapes'), ['quantity' => 3])
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas('cart.grapes', 3);

        $this->get(route('cart.index'))
            ->assertOk()
            ->assertSee('$14.97');

        $this->delete(route('cart.destroy', 'grapes'))
            ->assertRedirect(route('cart.index'))
            ->assertSessionMissing('cart.grapes');
    }

    public function test_checkout_requires_items_and_clears_the_cart_after_submission(): void
    {
        $this->get(route('checkout'))
            ->assertRedirect(route('cart.index'));

        $this->withSession(['cart' => ['grapes' => 1]])
            ->get(route('checkout'))
            ->assertOk()
            ->assertSee('$7.99');

        $this->withSession(['cart' => ['grapes' => 1]])
            ->post(route('checkout.store'), [
                'first_name' => 'Ayu',
                'last_name' => 'Putri',
                'email' => 'ayu@example.com',
                'phone' => '08123456789',
                'address' => 'Jalan Melati 10',
                'city' => 'Bandung',
                'postcode' => '40111',
            ])
            ->assertRedirect(route('home'))
            ->assertSessionMissing('cart');
    }

    public function test_contact_messages_are_validated_and_sent(): void
    {
        Mail::fake();

        $this->post(route('contact.store'), [
            'name' => 'Ayu Putri',
            'email' => 'ayu@example.com',
            'message' => 'Mohon informasi produk.',
        ])
            ->assertRedirect(route('contact'))
            ->assertSessionHas('status');
    }

    public function test_unknown_products_return_not_found(): void
    {
        $this->get(route('shop.show', 'not-a-product'))->assertNotFound();
    }
}
