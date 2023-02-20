<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\Payment;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Options;
use Iyzipay\Request\CreatePaymentRequest;
use Iyzipay\Model\PaymentCard;
use Illuminate\Support\Carbon;
class CheckoutController extends Controller
{
   public function index(){
       return view("frontend.checkout.index");
   }


   public function checkout(Request $request){


       $ip = $request->ip();
       $name=$request->name;
       $cart_no=$request->cart_no;
       $expire_month=$request->expire_month;
       $expire_year=$request->expire_year;
       $cvc=$request->cvc;
       $user = Auth::user();
       $code = $this->getOrCreateCart()->code;
       $total= $this->calculateCartTotal();
       if ($user->addrs[0]->is_default == 1){
        $address  = $user->addrs[0]->address;
        $city = $user->addrs[0]->city;
        $zipcode = $user->addrs[0]->zipcode;

       }


       $options = new Options();
       $options->setApiKey(env("TEST_IYZI_API_KEY"));
       $options->setSecretKey(env("TEST_IYZI_SECRET_KEY"));
       $options->setBaseUrl(env("TEST_IYZI_BASE_URL"));

       $request = new CreatePaymentRequest();
       $request->setLocale(Locale::TR);
       $request->setConversationId($code);
       $request->setPrice($total);
       $request->setPaidPrice($total);
       $request->setCurrency(Currency::TL);
       $request->setInstallment(1);
       $request->setBasketId($code);
       $request->setPaymentGroup(PaymentGroup::PRODUCT);



       $paymentCard = new PaymentCard();
       $paymentCard->setCardHolderName($name);
       $paymentCard->setCardNumber($cart_no);
       $paymentCard->setExpireMonth($expire_month);
       $paymentCard->setExpireYear($expire_year);
       $paymentCard->setCvc($cvc);
       $paymentCard->setRegisterCard(0);
       $request->setPaymentCard($paymentCard);

       $buyer = new Buyer();

       $buyer->setId($user->id);
       $buyer->setName($user->name);
       $buyer->setSurname($user->name);
       $buyer->setGsmNumber($user->tel);
       $buyer->setEmail($user->email);
       $buyer->setIdentityNumber("74300864791");
       $buyer->setLastLoginDate(Carbon::parse($user->updated_at)->format("Y-m-d h:i:s"));
       $buyer->setRegistrationDate(Carbon::parse($user->created_at)->format("Y-m-d h:i:s"));
       $buyer->setRegistrationAddress($address);
       $buyer->setIp($ip);
       $buyer->setCity($city);
       $buyer->setCountry("Turkey");
       $buyer->setZipCode($zipcode);
       $request->setBuyer($buyer);

       $billingAddress = new Address();
       $billingAddress->setContactName($user->name);
       $billingAddress->setCity($city);
       $billingAddress->setCountry("Turkey");
       $billingAddress->setAddress($address);
       $billingAddress->setZipCode($zipcode);
       $request->setBillingAddress($billingAddress);


       $request->setBuyer($buyer);
       $shippingAddress = new \Iyzipay\Model\Address();
       $shippingAddress->setContactName("Jane Doe");
       $shippingAddress->setCity("Istanbul");
       $shippingAddress->setCountry("Turkey");
       $shippingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
       $shippingAddress->setZipCode("34742");
       $request->setShippingAddress($shippingAddress);



       $basketItems = array();
       $firstBasketItem = new \Iyzipay\Model\BasketItem();
       $firstBasketItem->setId("BI101");
       $firstBasketItem->setName("Binocular");
       $firstBasketItem->setCategory1("Collectibles");
       $firstBasketItem->setCategory2("Accessories");
       $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
       $firstBasketItem->setPrice("11.0");
       $basketItems[0] = $firstBasketItem;

       $secondBasketItem = new \Iyzipay\Model\BasketItem();
       $secondBasketItem->setId("BI102");
       $secondBasketItem->setName("Game code");
       $secondBasketItem->setCategory1("Game");
       $secondBasketItem->setCategory2("Online Game Items");
       $secondBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
       $secondBasketItem->setPrice("0.9");

       $basketItems[1] = $secondBasketItem;
       $thirdBasketItem = new \Iyzipay\Model\BasketItem();
       $thirdBasketItem->setId("BI103");
       $thirdBasketItem->setName("Usb");
       $thirdBasketItem->setCategory1("Electronics");
       $thirdBasketItem->setCategory2("Usb / Cable");
       $thirdBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
       $thirdBasketItem->setPrice("0.1");
       $basketItems[2] = $thirdBasketItem;
       $request->setBasketItems($basketItems);


       $payment = Payment::create($request, $options);
       if ($payment->getStatus() == "success"){

           dd("ödeme ok");
           dd($payment->getErrorMessage());
       }
       else{
           dd($payment->getErrorMessage());
       }


   }

    private function calculateCartTotal(): float
    {
        $products= Product::all();
        $total = 0;
        $cart = $this->getOrCreateCart();
        $cartDetails = $cart->details;
        foreach ($products as $product){
        foreach ($cartDetails as $detail) {
            if ($product->id == $detail->product_id){
            $total += $product->price * $detail->quantity;
        }
        }
        }

        return $total;
    }

    /**
     *
     * Lists the cart content
     *
     * @return Cart
     */
    public function getOrCreateCart(): Cart
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id],
            ['code' => Str::random(8)]
        );
        return $cart;
    }


    private function getBasketItems(): array
    { $products= Product::all();
        $categories= Category::all();
        $basketItems = array();
        $cart = $this->getOrCreateCart();
        $cartDetails = $cart->details;
        foreach ($categories as $category){
            foreach ($products as $product){
                foreach ($cartDetails as $detail) {
                    if ($category->id == $product->category_id){
                    if ($product->id == $detail->product_id){

                        $item = new BasketItem();
                        $item->setId($detail->product_id);
                        $item->setName($product->name);
                        $item->setCategory1($category->name);
                        } break;
                        $item->setItemType(BasketItemType::PHYSICAL);
                        $item->setPrice($product->price);

                        for ($i = 0; $i < $detail->quantity; $i++) {
                            array_push($basketItems, $item);
                        } berak; }
                }
            }
        }


        return $basketItems;
    }


}
