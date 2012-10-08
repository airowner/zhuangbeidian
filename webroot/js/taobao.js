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

