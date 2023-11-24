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

// for文を組み合わせて関数の引数を指定
for (var i = 1; i < 7; i++) {
    $(".originalContents").each(function () {
    moreOrCloseIndex($(this), ".originalMenu_list"+i, ".more_btn"+i, ".close_btn"+i)
});
}

for (var i = 1; i < 7; i++) {
    $(".sharedContents").each(function () {
    moreOrCloseIndex($(this), ".sharedMenu_list"+i, ".more_btn"+i, ".close_btn"+i)
});
}

// more_btnを押すとすぐにリロードし、元に戻ってしまう
$(".sharedContents_a").each(function () {
    moreOrCloseIndex($(this), ".sharedMenu_list_a", ".more_btn", ".close_btn")
});
