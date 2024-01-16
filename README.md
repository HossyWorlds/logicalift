<p align="center">
    <img src="https://github.com/HossyWorlds/logicalift/assets/124346220/4d5d10fe-cc6f-4f23-9c5f-daece5ab6663" width="" height="400">
    <img src="https://github.com/HossyWorlds/logicalift/assets/124346220/e19215cf-c729-405f-b280-8a9770818e9e" width="" height="400">
    <img src="https://github.com/HossyWorlds/logicalift/assets/124346220/86c69282-6539-4b9f-9505-ef0e93b8507b" width="" height="400">
</p>

<p align="center">
    <!-- フレームワーク一覧 -->
    <img src="https://img.shields.io/badge/-Laravel-E74430.svg?logo=laravel&style=plastic">
    <!-- フロントエンドの言語一覧 -->
    <img src="https://img.shields.io/badge/-Html5-E34F26.svg?logo=html5&style=plastic">
    <img src="https://img.shields.io/badge/-Css3-1572B6.svg?logo=css3&style=plastic">
    <img src="https://img.shields.io/badge/-Javascript-F7DF1E.svg?logo=javascript&style=plastic">
    <!-- バックエンドの言語一覧 -->
    <img src="https://img.shields.io/badge/-Php-777BB4.svg?logo=php&style=plastic">
    <!-- ミドルウェア一覧 -->
    <img src="https://img.shields.io/badge/-Mysql-4479A1.svg?logo=mysql&style=plastic">
    <!-- インフラ一覧 -->
    <img src="https://img.shields.io/badge/-Amazon%20aws-232F3E.svg?logo=amazon-aws&style=plastic">
</p>

## logicaliftについて

ユーザーのトレーニングデータに基づき、重量やレップ数をアドバイスしてくれるアプリケーションです。
筋トレには漸進性の原則といったものがあり、毎度トレーニングの負荷を高めていく必要があります。現在自分が何キロを何回やれるのかは「感覚」で判断するのが通常ですが、これがあれば時間や脳のリソースの節約になります。


## アドバイスの根拠は？

RM換算表と呼ばれる指標があります。Max重量早見表とも言います。
RMとはRepetition Maximumの略で、ある「重さ」で「何回」持ち上げられるかを示してくれる表になります。例えば、ベンチプレス「40kg」を「11回」持ち上げられると、それは「51kg」を「1回」持ち上げられる能力に等しいことがひと目でわかります。また、そこから派生して「42.5kg」を「8回」やれる能力が備わっていることもわかります。「8回」できればステップアップには十分です。これで次回のトレーニングの重さを「42.5kg」に設定するタイミングがわかりました。このようなことをアプリではやりたかったのです。
ただ単にRM換算を行ってくれるだけのツールは存在します。しかし、ユーザーの過去の実績をデータベース化し、それを考慮したうえで適切なタイミングをアドバイスしてくれるようなツールはありませんでした。それを実現するのが、この『logicalift』です！！
