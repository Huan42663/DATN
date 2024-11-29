import './bootstrap';

window.Echo.channel('broadcast-voucher').listen('VoucherEvent',function(event){
    console.log(event)
});