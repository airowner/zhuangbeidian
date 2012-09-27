<script>
TOP.api('rest','get',{
    method:'taobaoke.widget.shops.convert',
    //session:'usersession',
    //timestamp:'1131333445560',
    fields:'user_id,click_url,shop_title,commission_rate,seller_credit,shop_type,auction_count,total_auction'
},function(resp){
    alert(JSON.stringify(resp));
    if(resp.user){
        alert('success!');
    }else{
        alert('failure!');
    } });
</script>
