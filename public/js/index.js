import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.$ = window.jQuery = require('jquery');
window.addEventListener('DOMContentLoaded', function(){
    // 初期表示数
    const init = 5;
    //追加表示数
    const more = 3;
    //初期表示数以降のリスト内容を非表示に
    
    $("menusList li:nth-child(n+" + (init+1) + ")").hide();
    
    //つづきは「https://mgmgblog.com/post-3374/」のリンク
    /** jQueryの処理 */ 

});