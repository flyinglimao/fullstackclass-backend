@component('mail::message')


<h4>親愛的{{Auth::user()->name}}您好:</h4>
<h4>感謝您對本公司的厚愛</h4>
<h4>以下是您的訂單</h4>
<table>
    <tr>
        <td>發票編號: </td>
        <td>{{$order->invoice_number}}</td>
    </tr>
    <tr>
        <td>收件人: </td>
        <td>{{$order->receiver}}</td>
    </tr>
    <tr>
        <td>收件人電話號碼: </td>
        <td>{{$order->receiver_phone}}</td>
    </tr>
    <hr>
    <tr>
        <td>商品名稱</td>
        <td>商品單價</td>
        <td>商品數量</td>
        <td>總價</td>
    </tr>
    @foreach(json_decode($order->products,true) as $product_id=>$quantity)
    <tr>
            <td>{{\App\Product::find($product_id)->title}}</td>
            <td>{{\App\Product::find($product_id)->sale_price}}</td>
            <td>{{$quantity}}本</td>
            <td>{{$quantity*\App\Product::find($product_id)->sale_price}}元</td>
    </tr>
    @endforeach
    <hr>
    <tr>
        <td>總價: </td>
        <td>{{json_decode($order->payment_information)->total}}元</td>
    </tr>
</table>
如果想了解詳細資訊，請點以下按鈕
@component('mail::button', ['url' => 'http://www.google.com'])
    詳細資訊
@endcomponent
祝您購物愉快,<br>
{{ config('app.name') }}
@endcomponent
