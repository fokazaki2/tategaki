# tategaki
日本語の縦書きを実現するため、縦書きの画像を作成して出力するというのを簡単につくってみました

できればライブラリ化して使いやすくしたいところなんですが、とりあえず実験的にやってます。
フォント単位に回転させて位置を調整するという手段をしています。

ほとんどのフォントは回転するだけでいけるんですが、記号あたりがずれるので、ずれるやつらをできるだけまとめて調整するという方式です。

フォントによって位置が違ったりするので、フォントによっても調整していく感じですね。

このあたりをもっと自動化できると便利なんですが、なにかいい方法ありましたらご協力ください。
