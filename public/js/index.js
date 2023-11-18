// $(function(){
//     alert('jquery')
// })

$(function () {
    const originalMenus = $(".originalMenu_list").length
    const sharedMenus = $(".sharedMenu_list").length
    
    $(".originalContents").each(function () {
        let number = 3
        let closeNumber = number - 1
        if (originalMenus <= number) {
            $(this).find(".more_btn1").hide()
        }
        $(this).find(".close_btn1").hide()
        $(this).find("form:not(:lt("+ number +"))").hide()
        // 両サイドに+がある理由は、""で包む際に変数も青色になってしまうから
        $(".more_btn1").click(function () {
            number += 3
            $(this).parent().find("form:lt("+ number +")").slideDown()
            if (originalMenus <= number) {
                $(".more_btn1").hide()
                $(".close_btn1").show()
                $(".close_btn1").click(function () {
                    $(this).parent().find("form:gt("+ closeNumber +")").slideUp()
                    $(this).hide()
                    $(".more_btn1").show()
                })
            }
        })
    })
    
    $(".sharedContents").each(function () {
        let number = 3
        let closeNumber = number - 1
        if (sharedMenus <= number) {
            $(this).find(".more_btn2").hide()
        }
        $(this).find(".close_btn2").hide()
        $(this).find("li:not(:lt("+ number +"))").hide()
        // 両サイドに+がある理由は、""で包む際に変数も青色になってしまうから
        $(".more_btn2").click(function () {
            number += 3
            $(this).parent().find("li:lt("+ number +")").slideDown()
            if (sharedMenus <= number) {
                $(".more_btn2").hide()
                $(".close_btn2").show()
                $(".close_btn2").click(function () {
                    $(this).parent().find("li:gt("+ closeNumber +")").slideUp()
                    $(this).hide()
                    $(".more_btn2").show()
                })
            }
        })
    })
})
