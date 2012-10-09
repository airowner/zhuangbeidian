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
        fields: 'num_iid,title,click_url,shop_click_url,seller_credit,pic_url,item_imgs,num,track_iid,cid,list_time,delist_time,modified,price,nick,desc,volume,prop_img,props,props_name,property_alias,auction_point,approve_status,detail_url,ems_fee,express_fee,post_fee,freight_payer,has_discount,has_invoice,has_warranty,has_showcase,is_virtual,stuff_status,seller_cids,input_pids,input_str,type,valid_thru,postage_id,outer_id,skus',
        //fields: 'num_iid,seller_id,nick,title,price,item_location,seller_credit_score,click_url,shop_click_url,pic_url,taobaoke_cat_click_url,keyword_click_url,coupon_rate,coupon_price,coupon_start_time,coupon_end_time,commission_rate,commission,commission_num,commission_volume,volume,shop_type',
        seller_nicks: seller_nick
    }, callback);
}
