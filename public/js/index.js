// $(function(){
//     alert('jquery')
// })

// $(function () {
//     const originalMenus = $(".originalMenu_list").length
//     const sharedMenus = $(".sharedMenu_list").length
    
//     $(".originalContents").each(function () {
//         let number = 3
//         let closeNumber = number - 1
//         if (originalMenus <= number) {
//             $(this).find(".more_btn1").hide()
//         }
//         $(this).find(".close_btn1").hide()
//         $(this).find("form:not(:lt("+ number +"))").hide()
//         // 両サイドに+がある理由は、""で包む際に変数も青色になってしまうから
//         $(".more_btn1").click(function () {
//             number += 3
//             $(this).parent().find("form:lt("+ number +")").slideDown()
//             if (originalMenus <= number) {
//                 $(".more_btn1").hide()
//                 $(".close_btn1").show()
//                 $(".close_btn1").click(function () {
//                     $(this).parent().find("form:gt("+ closeNumber +")").slideUp()
//                     $(this).hide()
//                     $(".more_btn1").show()
//                 })
//             }
//         })
//     })
    
//     $(".sharedContents").each(function () {
//         let number = 3
//         let closeNumber = number - 1
//         if (sharedMenus <= number) {
//             $(this).find(".more_btn2").hide()
//         }
//         $(this).find(".close_btn2").hide()
//         $(this).find("form:not(:lt("+ number +"))").hide()
//         // 両サイドに+がある理由は、""で包む際に変数も青色になってしまうから
//         $(".more_btn2").click(function () {
//             number += 3
//             $(this).parent().find("form:lt("+ number +")").slideDown()
//             if (sharedMenus <= number) {
//                 $(".more_btn2").hide()
//                 $(".close_btn2").show()
//                 $(".close_btn2").click(function () {
//                     $(this).parent().find("form:gt("+ closeNumber +")").slideUp()
//                     $(this).hide()
//                     $(".more_btn2").show()
//                 })
//             }
//         })
//     })
// })

function moreOrCloseIndex($section, $menu_list, $more_btn, $close_btn) {
    let $menus = $section.find($menu_list);
    let menus = $menus.length;
    let number = 3;
    let closeNumber = number - 1;
    let $moreBtn = $section.find($more_btn);
    let $closeBtn = $section.find($close_btn);
    
    if (menus <= number) {
        $moreBtn.hide();
    }

    $closeBtn.hide();
    $menus.not(":lt(" + number + ")").hide();

    $moreBtn.click(function () {
        number += 3;
        $menus.filter(":lt(" + number + ")").slideDown();

        if (menus <= number) {
            $moreBtn.hide();
            $closeBtn.show();

            $closeBtn.click(function () {
                $menus.filter(":gt(" + closeNumber + ")").slideUp();
                $closeBtn.hide();
                $moreBtn.show();
            });
        }
    });
}

$(".originalContents").each(function () {
    moreOrCloseIndex($(this), ".originalMenu_list", ".more_btn1", ".close_btn1")
});

$(".sharedContents").each(function () {
    moreOrCloseIndex($(this), ".sharedMenu_list", ".more_btn2", ".close_btn2")
});
