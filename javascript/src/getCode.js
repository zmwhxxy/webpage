/*产生随机数*/
function validateCode(n) {
    /*验证码中可能包含的字符*/
    var s = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890";
    var ret = "";   //保存生成的验证码
    
    /*利用循环，随机产生验证码中的每个字符*/
    for(var i=0; i<n; i++) {
        /*随机产生一个0-62之间的数值*/
        var index = Math.floor(Math.random() * 62);
        ret += s.charAt(index);
    }

    return ret;
}

/**显示随机数函数 */
function show() {
    // 在id为msg的对象中验证码
    document.getElementById("msg").innerHTML = validateCode(4);
}

// 页面加载时调用show函数
window.onload = show;