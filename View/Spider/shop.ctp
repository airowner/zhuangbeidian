
<script src="http://a.tbcdn.cn/apps/top/x/sdk.js?appkey=21181372"></script>
<script>
TOP.api('rest','get',{
    method:'taobaoke.widget.shops.convert',
    //session:'usersession',
    timestamp: +(new Date),
    seller_nicks:'<?php echo $nick; ?>',
    fields:'user_id,click_url,shop_title,commission_rate,seller_credit,shop_type,auction_count,total_auction'
},function(resp){
    alert(JSON.stringify(resp));
    if(resp.user){
        alert('success!');
    }else{
        alert('failure!');
    } 
});
</script>
