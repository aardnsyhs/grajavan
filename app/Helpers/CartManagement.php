<?php

namespace App\Helpers;

use App\Models\Book;
use Illuminate\Support\Facades\Cookie;

class CartManagement {
    // add item to cart
    static public function addItemToCart($book_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['book_id'] == $book_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_price'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_price'];
        } else {
            $book = Book::where('id', $book_id)->first(['id', 'title', 'price', 'image']);
            if ($book) {
                $cart_items[] = [
                    'book_id' => $book_id,
                    'title' => $book->title,
                    'image' => $book->image,
                    'quantity' => 1,
                    'unit_price' => $book->price,
                    'total_price' => $book->price,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    // add item to cart with quantity
    static public function addItemToCartWithQty($book_id, $qty = 1)
    {
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['book_id'] == $book_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] = $qty;
            $cart_items[$existing_item]['total_price'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_price'];
        } else {
            $book = Book::where('id', $book_id)->first(['id', 'title', 'price', 'image']);
            if ($book) {
                $cart_items[] = [
                    'book_id' => $book_id,
                    'title' => $book->title,
                    'image' => $book->image,
                    'quantity' => $qty,
                    'unit_price' => $book->price,
                    'total_price' => $book->price,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    // remove item from cart
    static public function removeFromCart($book_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['book_id'] == $book_id) {
                unset($cart_items[$key]);
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // add cart items to cookie
    static public function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    // clear cart items from cookie
    static public function clearCartItemsFromCookie()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // get all cart items from cookie
    static public function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items', '[]'), true);
        if (!$cart_items) {
            $cart_items = [];
        }

        return $cart_items;
    }

    // increment item quantity
    static public function incrementQuantityToCartItem($book_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['book_id'] == $book_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_price'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_price'];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // decrement item quantity
    static public function decrementQuantityToCartItem($book_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['book_id'] == $book_id) {
                if ($cart_items[$key]['quantity'] > 1) {
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_price'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_price'];
                }
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // calculate grand total
    static public function calculateGrandTotal($items)
    {
        return array_sum(array_column($items, 'total_price'));
    }
}
