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

//{"taobaoke_items":{"taobaoke_item":[{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzXh15Xy3ppPVHr2fr3aZc24UZy5R21%2BdtOl%2BeT1MJ3tp6Xvl4GQDdIf%2BEmtXjkDKgXbuE6tM%2FIsXBqL0nbRQOYfq2sOirJYG60wqMIkm4cXrm77NqPq0Sfqw5ZaCwQXKea8w%3D%3D&pid=mm_17531361_0_0&spm=2014.21181372.1.0","commission":"9.90","commission_num":"113","commission_rate":"1000.00","commission_volume":"1084.89","item_location":"广东 广州","nick":"gzhmgzhm","num_iid":15516502019,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T18nPzXeBfXXckM8o0_035940.jpg","price":"99.00","seller_credit_score":13,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTdjPgsrLcb7lX7W8cZ%2FSuLjNEf0a2N3HCucsTK%2FdSb3iB6Zcd%2Fo6wfZzaB0thHCGo%2B3Tje0W%2FdxxvmpqjvOk%2BHr%2Br9imvMKYPkGMgq7b6FudXNqmQ%3D&pid=mm_17531361_0_0&spm=2014.21181372.1.0","title":"茵曼 2012秋冬装新款纯棉大码长袖针织衫开衫小外套女823131258","volume":1226}]},"total_results":1}
TB.getItems = function(num_iids, callback)
{
    TB.get({
        method: 'taobao.taobaoke.widget.items.convert',
        fields: 'num_iid,seller_id,nick,title,price,item_location,seller_credit_score,click_url,shop_click_url,pic_url,taobaoke_cat_click_url,keyword_click_url,coupon_rate,coupon_price,coupon_start_time,coupon_end_time,commission_rate,commission,commission_num,commission_volume,volume,shop_type',
        num_iids: num_iids 
    }, callback);
}
