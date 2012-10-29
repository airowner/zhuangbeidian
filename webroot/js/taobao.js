var TB = TB || {};

TB.debug = function(content)
{
    console.log(JSON.stringify(content));
}

TB.basecallback = function(resp)
{
    TB.debug(resp);
}

TB.basefetch = function(http_method, data, callback)
{
	if(!TB.inited) TB.init();
    http_method = http_method || 'get';
    var request = {
        //method: data.method,
        session: $.cookie('sign'),
        timestamp: $.cookie('timestamp') 
    };
    data = $.extend(request, data);

    TOP.api('rest', http_method, data, callback);
}

TB.get = function(data, callback)
{
    TB.basefetch('get', data, callback);
}

TB.post = function(data, callback)
{
    TB.basefetch('post', data, callback);
}

TB.inited = false;
TB.init = function()
{
	TOP.init({
	    appKey: 21181372,
	    channelUrl: '/channel.html'
	});
	TB.inited = true;
}

TB.getShop = function(seller_nick, callback)
{
    TB.get({
        method: 'taobao.taobaoke.widget.shops.convert',
        fields: 'shop_id,user_id,seller_nick,shop_title,click_url,commission_rate,auction_count,seller_credit,shop_type,total_auction',
        seller_nicks: seller_nick
    }, callback);
}

TB.getItems = function(num_iids, callback)
{
    TB.get({
        method: 'taobao.taobaoke.widget.items.convert',
        fields: 'num_iid,seller_id,nick,title,price,item_location,seller_credit_score,click_url,shop_click_url,pic_url,taobaoke_cat_click_url,keyword_click_url,coupon_rate,coupon_price,coupon_start_time,coupon_end_time,commission_rate,commission,commission_num,commission_volume,volume,shop_type',
        num_iids: num_iids 
    }, callback);
}

TB.logined = function(nick, callback)
{
    TB.get({
        method: 'taobao.widget.loginstatus.get',
        nick: nick
    }, function(resp){
        if(resp && resp.slice){
            logined = resp[0];
            if(logined){
                callback(logined);
            }
        }
        //alert('un logined!');
    });
}

TB.cartPanel = function(nick, callbak)
{
    TB.logined(nick, function(){
        TB.get({
            method: 'taobao.widget.cartpanel.get',
        }, callback);
    });
}
