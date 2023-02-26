<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Order;
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

       foreach ($user->addrs as $item) {
           if ($item->is_default == 1) {
               $address= $item->address;
               $city = $item->city;
               $zipcode = $item->zipcode;
               break;

           }
       }

       $code = $this->getOrCreateCart()->code;
       $total= $this->calculateCartTotal();




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

       $buyer->setId($user->user_id);
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
       $shippingAddress->setContactName($name);
       $shippingAddress->setCity($city);
       $shippingAddress->setCountry("Turkey");
       $shippingAddress->setAddress($address);
       $shippingAddress->setZipCode($zipcode);
       $request->setShippingAddress($shippingAddress);

       $basketItems = $this->getBasketItems();
       $request->setBasketItems($basketItems);


      $payment = Payment::create($request, $options);
       if ($payment->getStatus() == "success"){

           $cart = $this->getOrCreateCart();
           $cart->is_active = false;
           $cart->save();

           $order = new Order([
               "cart_id"=> $cart->cart_id,
               "code"=>$cart->code
           ]);
           $order->save();

           foreach ($cart->details as $detail) {
               $order->details()->create([
                   'order_id' => $order->order_id,
                   'product_id' => $detail->product_id,
                   'quantity' => $detail->quantity
               ]);
           }

           $invoice = new Invoice([
               'order_id' => $order->order_id,
               'code' => $order->code,
           ]);
           $invoice->save();


           foreach ($order->details as $detail) {
               $invoice->details()->create([
                   'product_id' => $detail->product_id,
                   'quantity' => $detail->quantity,
                   'unit_price' => $detail->product->price,
                   'total' => ($detail->quantity * $detail->product->price),
               ]);
           }
            return view("frontend.checkout.success");
       } else{
           $error = $payment->getErrorMessage();
          return view("frontend.checkout.error", compact('error'));

       }



   }

    private function calculateCartTotal(): float
    {
        $total = 0;
        $cart = $this->getOrCreateCart();
        $cartDetails = $cart->details;
        foreach ($cartDetails as $detail) {
            $total += $detail->product->price * $detail->quantity;
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
            ['user_id' => $user->user_id],
            ['code' => Str::random(8)]
        );
        return $cart;
    }


    private function getBasketItems()
    {
        $basketItems = array();
        $cart = $this->getOrCreateCart();
        $cartDetails = $cart->details;
        foreach ($cartDetails as $detail) {
            $item = new BasketItem();
            $item->setId($detail->product_id);
            $item->setName($detail->product->name);
            $item->setCategory1($detail->product->category->name);
            $item->setItemType(BasketItemType::PHYSICAL);
            $item->setPrice($detail->product->price);

            for ($i = 0; $i < $detail->quantity; $i++) {
                array_push($basketItems, $item);
            }
        }

        return $basketItems;
    }


}
