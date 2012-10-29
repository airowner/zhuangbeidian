<?php
$itemid = $this->request->pass[0];
$num_iid = $this->request->pass[1];
$nick = $this->request->pass[2];
?>

<div id="result">
Loading ...... , please wait a moment!!
</div>
<script>
var getshop = false, getitem = false;
var itemid = '<?php echo $itemid; ?>';
var nick = '<?php echo $nick; ?>';
TB.getShop(nick, function(resp){
    $.post('/Spider/shop', resp, function(result){
		//alert('shop');
		//alert(JSON.stringify(resp));
        getshop = result;
    });
});

var num_iid = '<?php echo $num_iid; ?>';
TB.getItems(num_iid, function(resp){
    $.post('/Spider/item', resp, function(result){
		//alert('item');
		//alert(JSON.stringify(resp));
        getitem = result;
    });
});

var t = 0;
function check(){
    if(getshop && getitem){
        window.location = '/tagItem/add/' + itemid;
    }else{
        if( t > 30000 ){
            if(getshop === false){
                $('#result').html('商店信息获取出错!');
            }else if(getitem === false){
                $('#result').html('商品信息获取出错!');
            }else{
                $('#result').html('信息保存出错!');
            }
        }else{
            setTimeout(check, 500);
            t += 500;
        }
    }
}

check();
</script>
