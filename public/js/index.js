$(function () {
    const originalMenus = $(".originalMenu-list").length
    const sharedMenus = $(".sharedMenu-list").length
    
    $(".originalContents").each(function () {
        let number = 3
        let closeNumber = number - 1
        if (originalMenus <= number) {
            $(this).find(".more-btn1").hide()
        }
        $(this).find(".close-btn1").hide()
        $(this).find("li:not(:lt("+ number +"))").hide()
        // 両サイドに+がある理由は、""で包む際に変数も青色になってしまうから
        $(".more-btn1").click(function () {
            number += 3
            $(this).parent().find("li:lt("+ number +")").slideDown()
            if (originalMenus <= number) {
                $(".more-btn1").hide()
                $(".close-btn1").show()
                $(".close-btn1").click(function () {
                    $(this).parent().find("li:gt("+ closeNumber +")").slideUp()
                    $(this).hide()
                    $(".more-btn1").show()
                })
            }
        })
    })
    
    $(".sharedContents").each(function () {
        let number = 3
        let closeNumber = number - 1
        if (sharedMenus <= number) {
            $(this).find(".more-btn2").hide()
        }
        $(this).find(".close-btn2").hide()
        $(this).find("li:not(:lt("+ number +"))").hide()
        // 両サイドに+がある理由は、""で包む際に変数も青色になってしまうから
        $(".more-btn2").click(function () {
            number += 3
            $(this).parent().find("li:lt("+ number +")").slideDown()
            if (sharedMenus <= number) {
                $(".more-btn2").hide()
                $(".close-btn2").show()
                $(".close-btn2").click(function () {
                    $(this).parent().find("li:gt("+ closeNumber +")").slideUp()
                    $(this).hide()
                    $(".more-btn2").show()
                })
            }
        })
    })
})
